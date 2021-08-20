<?php

namespace App\Security\Voter;

use App\Entity\Order;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class OrderVoter extends Voter
{
    const CONFIRM = 'ORDER_CONFIRM';
    const CREATE = 'ORDER_CREATE';
    const EDIT = 'ORDER_EDIT';
    const SHOW = 'ORDER_SHOW';
    const DELETE = 'ORDER_DELETE';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::CONFIRM, self::CREATE, self::EDIT, self::SHOW, self::DELETE])
            && $subject instanceof Order;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        /** @var Order $subject */

        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        switch ($attribute) {
            case self::CONFIRM:
                return $this->canEdit($subject, $user);
                break;
            case self::EDIT:
                return $this->canEdit($subject, $user);;
                break;
            case self::SHOW:
                return $this->canShow($subject, $user);
                break;
            case self::DELETE:
                return $this->canEdit($subject, $user);
                break;
        }

        return false;
    }

    private function canShow(Order $order, UserInterface $user)
    {
        return $this->canEdit($order, $user);
    }

    private function canEdit(Order $order, UserInterface $user)
    {
        return $order->getUser() === $user;
    }
}
