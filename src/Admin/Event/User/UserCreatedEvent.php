<?php


namespace App\Admin\Event\User;


use App\Entity\User;

class UserCreatedEvent
{
    public function __construct(private User $user)
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}