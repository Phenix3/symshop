<?php

namespace App\Service\Payment;

use App\Entity\Order;
use App\Repository\ShopRepository;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Request;

class PaymentService
{

    /**
     * Undocumented function
     *
     * @param array $data
     * @param Request $request
     * @param Order $order
     */
    public function stripe($data, $request, $order)
    {
        $session = $request->getSession();

        if($session->has($order->getReference()))
        {
            $data['secret'] = $session->get($order->getReference());
        } else {
            Stripe::setApiKey($this->parameterBag->get('app.stripe_secret'));

            $intent = PaymentIntent::create([
                'amount' => (int) ($order->getTotal() * 100),
                'currency' => 'XAF',
                'metadata' => [
                    'reference' => $order->getReference()
                ]
            ]);

            $session->set($order->getReference(), $intent->client_secret);
            $data['secret'] = $intent->client_secret;
        }
        return $data;
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Order $order
     * @param ShopRepository $shopRepository
     * @return array
     */
    public function getData($request, $order, $shopRepository)
    {
        $shop = $shopRepository->findFirst();
        $data = ['shop' => $shop, 'order' => $order];
        $slug = $order->getState()->getSlug();

        if ($slug === 'card' || $slug === 'error') {
            $data = $this->stripe($data, $request, $order);
        }
        
        return $data;
    }
}