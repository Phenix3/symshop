<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Form\CheckoutAddressType;
use App\Form\OrderType;
use App\Repository\AddressRepository;
use App\Repository\CountryRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\ShopRepository;
use App\Repository\StateRepository;
use App\Service\Cart\CartService;
use App\Service\Payment\PaymentService;
use App\Service\Shipping\ShippingService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/order", name="order_")
 */
class OrderController extends AbstractController
{
    protected $productRepository;
    protected $addressRepository;
    protected $countryRepository;
    protected $translator;

    public function __construct(
        ProductRepository $productRepository,
        AddressRepository $addressRepository,
        CountryRepository $countryRepository,
        TranslatorInterface $translator
    ) {
        $this->productRepository = $productRepository;
        $this->addressRepository = $addressRepository;
        $this->countryRepository = $countryRepository;
        $this->translator = $translator;
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $orders = $this->getUser()->getOrders();
        return $this->render('order/index.html.twig', compact('orders'));
    }

    /**
     * @Route("/new", name="new")
     *
     * @param Request $request
     * @param ShippingService $shippingService
     * @param CartService $cartService
     *
     * @return void
     */
    function new (
        Request $request,
        ShippingService $shippingService,
        CartService $cartService,
        TokenGeneratorInterface $tokenGenerator,
        StateRepository $stateRepository
    ) {

        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('warning', 'alerts.unauthorized_to_order');
            // dump($this->get('session')->getFlashBag());
            return $this->redirectToRoute('shop_login');
        }

        $order = new Order();
        $order->setUser($this->getUser());
        $orderForm = $this->createForm(OrderType::class, $order);
        $checkoutAddressForm = $this->createForm(CheckoutAddressType::class); 
        $items = $cartService->getContent();

        if ($request->getMethod() === 'POST') {
            foreach ($items as $item) {
                $product = $this->productRepository->find($item->id);
                if ($product->getQuantity() < $item->quantity) {
                    $this->addFlash('error', $this->translator->trans('alerts.product_out_of_stock', [
                        'name' => $product->getName(),
                        'quantity' => $product->getQuantity(),
                    ]));

                    return $this->redirectToRoute('order_new');
                }
            }
            $em = $this->getDoctrine()->getManager();
            // dump($request->request);
            // Facturation
            $facturation_address = $this->addressRepository->findWithCountry($request->get('facturation'));

            // Livraison
            $shipping_address = $request->request->getBoolean('different') ?
            $this->addressRepository->findWithCountry($request->request->get('shipping')) :
            $facturation_address;
            $shipping = $request->request->get('expedition') === 'colissimo' ?
            $shippingService->compute($shipping_address->getCountry()) :
            0;

            // TVA
            $country = $this->countryRepository->findOneBy(['name' => 'Cameroun']);
            $tvaBase = $country->getTax();
            $tax = $request->request->get('expedition') === 'colissimo' ?
            $shipping_address->getCountry()->getTax() :
            $tvaBase;

            // Enregistrement commande
            $state = $stateRepository->findOneBy(['slug' => $request->request->get('payment')]);
            // dump($state);
            $order
                ->setReference($tokenGenerator->generateToken())
                ->setShipping($shipping)
                ->setTax($tax)
                ->setTotal($tax > 0 ? $cartService->getTotal() : $cartService->getTotal() / (1 + $tvaBase))
                // ->setPayment($request->request->get('payment'))
                ->setPick($request->request->get('shipping') === 'withdrawal')
                ->setState($state)
            ;

            // Enregistrement éventuel adresse de livraison
            if ($request->request->get('different')) {
                // $shipping_address->setIsProfessionnal(false);
            }

            // Enregistrement des produits
            $orderProduct = new OrderProduct();
            foreach ($items as $item) {
                $orderProduct
                    ->setProduct($item->associatedModel)
                    ->setQuantity($item->quantity)
                    ->setName($item->name)
                    ->setTotalPriceGross($tax > 0 ? $item->price : $item->price / (1 + $tvaBase) * $item->quantity)
                    ->setOrder($order)
                ;
                $product = $this->productRepository->find($item->id);
                $product->setQuantity($product->getQuantity() - $item->quantity);

                if ($product->getQuantity() <= $product->getQuantityAlert()) {
                    // TODO: Notification pour les admins
                }
                $em->persist($orderProduct);
            }
            /* $orderAddress = new Address();
            $orderAddress
                ->setAddress($shipping_address->getAddress())
                ->setOrder($order)
                ->setCountry($country)
                ->setAddressbis($shipping_address->getAddressbis())
                ->setBp($shipping_address->getBp())
                ->setCity($shipping_address->getCity())
                ->setCivility($shipping_address->getCivility())
                ->setCompany($shipping_address->getCompany())
                ->setFacturation($request->request->getBoolean('different') ?? false)
                ->setFirstName($shipping_address->getFirstName())
                ->setIsProfessionnal($shipping_address->getIsProfessionnal())
                ->setName($shipping_address->getName())
                ->setPostal()
                ; */
            $order
                ->setBillingAddress($facturation_address)
                ->setShippingAddress($shipping_address);
            $em->persist($order);
            $em->flush();

            $cartService->clear();

            // TODO: Notification pour les Admins et le User

            return $this->redirectToRoute('order_confirm', ['id' => $order->getId()]);
        }

        // $addresses = $this->addressRepository->findBy(['user' => $this->getUser()]);


        // $address = collect($addresses)->first();
        /**
         * @var Address $address
         */
        // $country_id = $address->getCountry()->getId();

        // dump($addresses, $address, $address->getCountry());

        return $this->render('order/new.html.twig', [
            // 'addresses' => $addresses,
            // 'shipping' => $shippingService->compute($country_id),
            'total' => $cartService->getTotal(),
            'cart' => $cartService->getContent(),
            // 'tax' => $this->countryRepository->findOneBy(['id' => $country_id])->getTax(),
            'form' => $orderForm->createView(),
            'checkoutAddressForm' => $checkoutAddressForm->createView()
        ]);
    }

    /**
     * @Route("/{id}/confirm", name="confirm")
     *
     */
    public function confirm(Request $request, $id, OrderRepository $orderRepository, ShopRepository $shopRepository, PaymentService $paymentService)
    {
        $order = $orderRepository->findWithRelations($id);
        $this->denyAccessUnlessGranted('ORDER_CONFIRM', $order);

        if (in_array($order->getState()->getSlug(), ['cheque', 'mandat', 'virement', 'card', 'erreur'])) {
            $data = $paymentService->getData($request, $order, $shopRepository);

            return $this->render('order/confirm.html.twig', $data);
        }
    }

    /* protected function getData($request, $order, $shopRepository)
    {
        $shop = $shopRepository->findFirst();
        $data = compact('shop', 'order');
        $slug = $order->getState()->getSlug();

        if ($slug === 'card' || $slug === 'erreur') {
            # TODO: Paiement bancaire par carte
        }
        
        return $data;
    } */

    /**
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @Route("/details", name="details")
     *
     * @param Request $request
     * @param ShippingService $shippingService
     * @param CartService $cartService
     *
     */
    public function details(
        Request $request,
        ShippingService $shippingService,
        CartService $cartService
    ) {
        $requestContent = \json_decode($request->getContent(), true);
        dump($requestContent);
        // Facturation
        $facturation_country = $this->addressRepository->find($requestContent['facturation'])->getCountry();

        $shipping_country = $requestContent['shipping'] ?
        $this->addressRepository->find($requestContent['shipping'])->getCountry() :
        $facturation_country;

        $shipping = $requestContent['pick'] ? 0 : $shippingService->compute($shipping_country->getId());

        $tvaBase = $this->countryRepository->findOneBy(['name' => 'Cameroun'])->getTax();
        $tax = $requestContent['pick'] ? $tvaBase : $shipping_country->getTax();

        $cart = $cartService->getContent();
        $total = $tax > 0 ? $cartService->getTotal() : $cartService->getTotal() / (1 + $tvaBase);
        dump($shipping, $cart, $total, $tax);
        return $this->json([
            'view' => $this->renderView('order/_details.html.twig', compact('shipping', 'cart', 'total', 'tax')),
        ]);
    }

    
}
