<?php

namespace App\EntityListener;

use App\Entity\Category;
use App\Entity\Page;
use App\Entity\Product;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class SluggerListener
{
    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($this->getTest($entity)) {
            return;
        }

        $entity->setSlug(
            \mb_strtolower($this->computeSlug($entity))
        );


    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($this->getTest($entity)) {
            return;
        }

        $entity->setSlug(
            \mb_strtolower($this->computeSlug($entity))
        );
    }

    private function computeSlug(object $entity): string
    {
        return \mb_strtolower($this->slugger->slug($entity->getSlug() ?: $entity->getName()));
    }

    private function getTest(object $entity): bool
    {
        return (
            (!$entity instanceof Category)
            && (!$entity instanceof Product)
            && (!$entity instanceof Page)
        );
    }
}