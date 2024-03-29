<?php

namespace App\EventSubscriber;

use App\Service\Cart\CartService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class CheckoutResolverSubscriber implements EventSubscriberInterface
{
    public const ROPUTES = [
        'cart' => 'checkout_address',
        'addressed' => 'checkout_shipping',
        'shipping_selected' => 'checkout_payment',
        'payment_selected' => 'complete',
        'completed' => 'order_show'
    ];

    public function onKernelRequest(RequestEvent $event)
    {
        /* if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        dump($request, $this->cartService->isEmpty());
        if ($this->cartService->isEmpty() && $request->attributes->get('_route') === 'checkout_address') {
            $this->flashBag->add('warning', 'alerts.checkout_empty_cart');
            $event->setResponse(new RedirectResponse($this->urlGenerator->generate('cart_index')));
        } */
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.request' => 'onKernelRequest',
        ];
    }
}
