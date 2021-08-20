<?php


namespace App\EntityListener;


use App\Entity\Review;
use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class ReviewEntityListener
{

    /**
     * @var Security
     */
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Review $review, LifecycleEventArgs $args): void
    {
        /** @var User $author */
        $author = $this->security->getUser();
        $review->setAuthor($author);
    }
}