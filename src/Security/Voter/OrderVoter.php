<?php

namespace App\Security\Voter;

use App\Entity\Order;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class OrderVoter extends Voter
{
    public const CONFIRM = 'ORDER_CONFIRM';
    public const CREATE = 'ORDER_CREATE';
    public const EDIT = 'ORDER_EDIT';
    public const SHOW = 'ORDER_SHOW';
    public const DELETE = 'ORDER_DELETE';

    public function __construct(private Security $security)
    {
    }

    protected function supports($attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::CONFIRM, self::CREATE, self::EDIT, self::SHOW, self::DELETE])
            && $subject instanceof Order;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }
        return match ($attribute) {
            self::CONFIRM => $this->canEdit($subject, $user),
            self::EDIT => $this->canEdit($subject, $user),
            self::SHOW => $this->canShow($subject, $user),
            self::DELETE => $this->canEdit($subject, $user),
            default => false,
        };
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
