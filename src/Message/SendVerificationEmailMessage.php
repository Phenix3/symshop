<?php

namespace App\Message;

use App\Entity\User;

final class SendVerificationEmailMessage
{
    public function __construct(private User $user)
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
