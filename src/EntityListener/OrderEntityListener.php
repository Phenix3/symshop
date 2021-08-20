<?php

namespace App\EntityListener;

use App\Entity\Order;
use App\Order\OrderReferenceGenerator;
use Doctrine\ORM\Event\LifecycleEventArgs;

class OrderEntityListener
{
    private $orderReferenceGenerator;

    public function __construct(OrderReferenceGenerator $orderReferenceGenerator)
    {
        $this->orderReferenceGenerator = $orderReferenceGenerator;
    }


    public function prePersist(Order $order, LifecycleEventArgs $event)
    {
        $order
            ->setCreatedAt(new \DateTime())
            ->setReference(
                $this->orderReferenceGenerator->generateReference()
            );
    }
}
