<?php

namespace App\EventSubscriber;

use App\Admin\Event\User\UserCreatedEvent;
use App\Admin\Event\User\UserDeletedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class UserSubscriber implements EventSubscriberInterface
{
    public function onUserCreated(UserCreatedEvent $event)
    {
        $user = $event->getUser();
    }

    public function onUserDeleted(UserDeletedEvent $event)
    {
        $user = $event->getUser();
    }

    public static function getSubscribedEvents()
    {
        return [
            UserCreatedEvent::class => 'onUserCreated',
            UserDeletedEvent::class => 'onUserDeleted',
        ];
    }
}
