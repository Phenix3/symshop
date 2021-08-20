<?php

namespace App\EntityListener;

use App\Entity\Page;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class PageEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Page $page, LifecycleEventArgs $event)
    {
        $page->computeSlug($this->slugger);
    }

    public function preUpdate(Page $page, LifecycleEventArgs $event)
    {
        $page->computeSlug($this->slugger);
    }
}
