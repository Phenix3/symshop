<?php

namespace App\EntityListener;

use App\Entity\Order;
use App\Order\OrderReferenceGenerator;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Repository\OrderRepository;

class OrderEntityListener
{
    private $orderReferenceGenerator;
    private $orderRepository;

    public function __construct(OrderReferenceGenerator $orderReferenceGenerator, OrderRepository $orderRepository)
    {
        $this->orderReferenceGenerator = $orderReferenceGenerator;
        $this->orderRepository = $orderRepository;
    }


    public function prePersist(Order $order, LifecycleEventArgs $event)
    {
        $count = $this->orderRepository->countForReference();
        $order
            ->setCreatedAt(new \DateTime())
            ->setReference(
                $this->orderReferenceGenerator->generateReference($count)
            );
    }
}
