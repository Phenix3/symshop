<?php

namespace App\EventSubscriber;

use App\Admin\Event\User\UserCreatedEvent;
use App\Admin\Event\User\UserDeletedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
{
    public function onUserCreated(UserCreatedEvent $event)
    {
        $event->getUser();
    }

    public function onUserDeleted(UserDeletedEvent $event)
    {
        $event->getUser();
    }

    public static function getSubscribedEvents(): array
    {
        return [
            UserCreatedEvent::class => 'onUserCreated',
            UserDeletedEvent::class => 'onUserDeleted',
        ];
    }
}
