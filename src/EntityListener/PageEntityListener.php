<?php

namespace App\EntityListener;

use App\Entity\Page;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class PageEntityListener
{
    public function __construct(private SluggerInterface $slugger)
    {
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
