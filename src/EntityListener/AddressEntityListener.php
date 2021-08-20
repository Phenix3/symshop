<?php

namespace App\EntityListener;

use App\Entity\Address;
use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class AddressEntityListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    public function prePersist(Address $address, LifecycleEventArgs $event)
    {
        /** @var User $user */
        $user = $this->security->getUser();
        $address
            ->setCreatedAt(new \DateTime())
            ->setUser($user);
    }
}
