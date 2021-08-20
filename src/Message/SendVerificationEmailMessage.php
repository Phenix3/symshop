<?php

namespace App\Message;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

final class SendVerificationEmailMessage
{
    /*
     * Add whatever properties & methods you need to hold the
     * data for this message class.
     */

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
