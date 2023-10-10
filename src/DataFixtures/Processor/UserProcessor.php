<?php

namespace App\DataFixtures\Processor;

use App\Entity\User;
use Fidry\AliceDataFixtures\ProcessorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserProcessor implements ProcessorInterface
{

    public function __construct(private UserPasswordHasherInterface $passwordEncoder)
    {
    }

    public function preProcess(string $id, $object): void
    {
        if (!$object instanceof User) {
            return;
        }
        $object->setPassword($this->passwordEncoder->hashPassword($object, $object->getPassword()));
    }

    public function postProcess(string $id, $object): void
    {
    }
}
