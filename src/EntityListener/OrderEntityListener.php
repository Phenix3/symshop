<?php

namespace App\EntityListener;

use DateTime;
use App\Entity\Order;
use App\Order\OrderReferenceGenerator;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Repository\OrderRepository;

class OrderEntityListener
{
    public function __construct(private OrderReferenceGenerator $orderReferenceGenerator, private OrderRepository $orderRepository)
    {
    }


    public function prePersist(Order $order, LifecycleEventArgs $event)
    {
        $order
            ->setCreatedAt(new DateTime())
            ->setReference(
                $this->orderReferenceGenerator->generateReference($this->orderRepository->count([]))
            );
    }
}