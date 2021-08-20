<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Payment;
use App\Form\CheckoutAddressType;
use App\Form\CheckoutCompleteType;
use App\Form\CheckoutPaymentType;
use App\Form\CheckoutShippingType;
use App\Message\OrderConfirmationEmail;
use App\Message\ProductQuantityAlertEmail;
use App\Repository\AddressRepository;
use App\Repository\CountryRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\StateRepository;
use App\Service\Address\AddressComparator;
use App\Service\Cart\CartService;
use App\Service\Shipping\ShippingService;
use Payum\Core\Payum;
use Payum\Core\Security\GenericTokenFactoryInterface;
use Payum\Core\Security\HttpRequestVerifierInterface;
use Payum\Core\Security\TokenInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/checkout", name="checkout_")
 */
class CheckoutController extends AbstractController
{

    private OrderRepository $orderRepository;
    private StateRepository $stateRepository;
    private ProductRepository $productRepository;
    private TranslatorInterface $translator;
    private CountryRepository $countryRepository;
    private Payum $payum;
    /**
     * @var AddressRepository
     */
    private AddressRepository $addressRepository;

    public function __construct(
        OrderRepository $orderRepository,
        StateRepository $stateRepository,
        ProductRepository $productRepository,
        TranslatorInterface $translator,
        CountryRepository $countryRepository,
    AddressRepository $addressRepository,
    Payum $payum
    ) {
        $this->orderRepository = $orderRepository;
        $this->stateRepository = $stateRepository;
        $this->productRepository = $productRepository;
        $this->translator = $translator;
        $this->countryRepository = $countryRepository;
        $this->addressRepository = $addressRepository;
        $this->payum = $payum;
    }

    /**
     * @Route("/")
     * @Route("/address", name="address")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param CartService $cartService
     * @param AddressComparator $addressComparator
     * @return Response
     */
    public function address(
        Request $request,
        CartService $cartService,
        AddressComparator $addressComparator
    ): Response
    {
        $order = new Order();
        $checkoutAddressForm = $this->createForm(CheckoutAddressType::class, $order);
        $checkoutAddressForm->handleRequest($request);

        if ($checkoutAddressForm->isSubmitted() && $checkoutAddressForm->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $items = $cartService->getContent();
            foreach ($items as $item) {
                $product = $this->productRepository->find($item->id);
                // $product = $item->associatedModel;
                if ($product->getQuantity() < $item->quantity) {
                    $this->addFlash('danger', $this->translator->trans('alerts.product_out_of_stock', [
                        'name' => $product->getName(),
                        'quantity' => $product->getQuantity(),
                    ]));

                    return $this->redirectToRoute('checkout_address');
                }

                $orderProduct = new OrderProduct();
                $orderProduct
                    ->setName($item->name)
                    ->setProduct($item->associatedModel)
                    ->setQuantity($item->quantity)
                    ->setTotalPriceGross($item->price)
                    ->setOrder($order)
                ;
                $product->setQuantity($product->getQuantity() - $item->quantity);

                if ($product->getQuantity() <= $product->getQuantityAlert()) {
                    $this->dispatchMessage(new ProductQuantityAlertEmail($product));
                }
                $orderProduct->setProduct($product);
                $order->addOrderProduct($orderProduct);

            }

            $state = $this->stateRepository->findOneBy(['slug' => 'addressed']);

            // Prevent address duplication

            $order
                ->setShippingAddress($this->verifyAddress($order->getShippingAddress()))
                ->setBillingAddress($this->verifyAddress($order->getBillingAddress()))
                ;
            $address1 = $order->getBillingAddress();
            $address2 = $order->getShippingAddress();
            if ($addressComparator->equal($address1, $address2)) {
                $order->setBillingAddress($address1)->setShippingAddress($address1);
            }
            $order
                ->setState($state)
                ->setCheckoutState('addressed')
                ->setPaymentState(Payment::STATE_CART)
                ->setUser($this->getUser())
                ->setTotal($cartService->getTotal())
            ;
            $entityManager->persist($order);
            $entityManager->flush();

            $cartService->clear();
            dump('Final call');
            return $this->redirectToRoute('checkout_shipping');
        }
        return $this->render('checkout/address.html.twig', [
            'checkoutAddressForm' => $checkoutAddressForm->createView(),
        ]);
    }

    /**
     * @Route("/shipping", name="shipping")
     *
     * @param Request $request
     * @param ShippingService $shippingService
     * @return RedirectResponse|Response
     */
    public function shipping(Request $request, ShippingService $shippingService): Response
    {
        $order = $this->orderRepository->findOneByUserForCheckout($this->getUser());
        $this->denyAccessUnlessGranted('ORDER_EDIT', $order);

        $checkoutShippingForm = $this->createForm(CheckoutShippingType::class, $order);
        $checkoutShippingForm->handleRequest($request);

        if ($checkoutShippingForm->isSubmitted() && $checkoutShippingForm->isValid()) {

            $shippingData = $checkoutShippingForm->get('shipping')->getData();

            $country = $this->countryRepository->findOneBy(['name' => 'Cameroun']);
            $tvaBase = $country->getTax();

            $tax = $shippingData === 'colissimo' ? $order->getShippingAddress()->getCountry()->getTax() : $tvaBase;

            $shipping = $shippingData === 'colissimo' ? $shippingService->compute($order->getBillingAddress()->getCountry()) : 0;
            $state = $this->stateRepository->findOneBy(['slug' => 'shipping-selected']);
            dump($state);
            $order
                ->setShipping($shipping)
                ->setTax($tax)
                ->setCheckoutState('shipping_selected')
                ->setState($state);

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'alerts.checkout_shipping_success');
            return $this->redirectToRoute('checkout_payment');
        }

        return $this->render('checkout/shipping.html.twig', [
            'checkoutShippingForm' => $checkoutShippingForm->createView(),
        ]);
    }

    /**
     * @Route("/payment", name="payment")
     *
     * @param Request $request
     * @return Response
     */
    public function payment(Request $request)
    {
        $user = $this->getUser();
        $order = $this->orderRepository->findOneByUserForCheckout($user);
        $this->denyAccessUnlessGranted('ORDER_EDIT', $order);

        $storage = $this->payum->getStorage(Payment::class);

        /** @var Payment $payment */
        $payment = $storage->create();
        $payment->setCurrencyCode('XAF');
        $payment->setNumber(uniqid());
        $payment->setClientEmail($user->getEmail());
        $payment->setClientId($user->getId());
        $payment->setOrder($order);
        $payment->setTotalAmount($order->getTotal());

        $order->addPayment($payment);

        $checkoutPaymentForm = $this->createForm(CheckoutPaymentType::class, $order);
        $checkoutPaymentForm->handleRequest($request);


        if ($checkoutPaymentForm->isSubmitted() && $checkoutPaymentForm->isValid()) {
            dump($checkoutPaymentForm->isSubmitted());
            $state = $this->stateRepository->findOneBy(['slug' => 'payment-selected']);
            $payment->setState(Payment::STATE_CART);
            $storage->update($payment);

            $captureToken = $this->getTokenFactory()->createCaptureToken(
                $payment->getMethod()->getGatewayConfig()->getGatewayName(),
                $payment,
                'done'
            );

            $order
                ->setState($state)
                ->setPaymentState(Payment::STATE_PROCESSING)
                ->setCheckoutState('payment_selected')
                ->setTokenValue($captureToken->getHash())
                ;
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('checkout_complete');
        }

        return $this->render('checkout/payment.html.twig', [
            'checkoutPaymentForm' => $checkoutPaymentForm->createView(),
        ]);
    }

    /**
     * @Route("/complete", name="complete")
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function complete(Request $request)
    {
        $order = $this->orderRepository->findOneByUserForCheckout($this->getUser());
        $this->denyAccessUnlessGranted('ORDER_CONFIRM', $order);

        $checkoutCompleteForm = $this->createForm(CheckoutCompleteType::class, $order);
        $checkoutCompleteForm->handleRequest($request);

        if ($checkoutCompleteForm->isSubmitted() && $checkoutCompleteForm->isValid()) {

            $state = $this->stateRepository->findOneBy(['slug' => 'awaiting_payment']);
            $order
                ->setState($state)
                ->setCheckoutState('completed')
                ->setCheckoutCompletedAt(new \DateTime())
                ;

            $this->getDoctrine()->getManager()->flush();

            // TODO: Invoice generation

            $this->dispatchMessage(new OrderConfirmationEmail($order));




            $this->addFlash('success', 'alerts.order_completed');

            return $this->redirectToRoute('home');
        }

        return $this->render('checkout/complete.html.twig', [
            'order' => $order,
            'checkoutCompleteForm' => $checkoutCompleteForm->createView()
        ]);
    }

    private function verifyAddress(Address $address)
    {
        $addr = $this->addressRepository->findToCompare([
            'address' => $address->getAddress(),
            'user' => $address->getUser(),
            'country' => $address->getCountry()
        ]);

        return $addr ?: $address;
    }

    private function getTokenFactory(): GenericTokenFactoryInterface
    {
        return $this->payum->getTokenFactory();
    }

    private function getHttpRequestVerifier(): HttpRequestVerifierInterface
    {
        return $this->payum->getHttpRequestVerifier();
    }

    private function provideTokenBasedOnPayment(Payment $payment, array $redirectOptions): TokenInterface
    {
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = $payment->getMethod();

        /** @var GatewayConfig $gatewayConfig */
        $gatewayConfig = $paymentMethod->getGatewayConfig();

        if (isset($gatewayConfig->getConfig()['use_authorize']) && true === (bool) $gatewayConfig->getConfig()['use_authorize']) {
            $token = $this->getTokenFactory()->createAuthorizeToken(
                $gatewayConfig->getGatewayName(),
                $payment,
                $redirectOptions['route']
                    ?? null,
                $redirectOptions['parameters']
                    ?? []
            );
        } else {
            $token = $this->getTokenFactory()->createCaptureToken(
                $gatewayConfig->getGatewayName(),
                $payment,
                $redirectOptions['route']
                    ?? null,
                $redirectOptions['parameters']
                    ?? []
            );
        }

        return $token;
    }
}
