<?php

namespace App\EntityListener;

use App\Entity\State;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class StateEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(State $state, LifecycleEventArgs $args): void
    {
        $state->setSlug($this->setSlug($state));
    }

    private function setSlug(State $state): string
    {
        return $state->getSlug()
        ? \mb_strtolower($this->slugger->slug($state->getSlug()))
        : \mb_strtolower($this->slugger->slug($state->getName()));
    }
}
