<?php

namespace App\EntityListener;


use DateTime;
use App\Entity\Address;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TimestampListener 
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (
            (!$entity instanceof User)
            && (!$entity instanceof Order)
            && (!$entity instanceof Address)
            && (!$entity instanceof Product)
        ) {
            return;
        }
        $entity->setCreatedAt(new DateTime());
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (
            (!$entity instanceof User)
            && (!$entity instanceof Order)
            && (!$entity instanceof Address)
            && (!$entity instanceof Product)
        ) {
            return;
        }
        $entity->setUpdatedAt(new DateTime());
    }
}