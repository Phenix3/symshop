<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{

    public const USER_EDIT = 'USER_EDIT';
    public const USER_SHOW = 'USER_SHOW';
    public const USER_DELETE = 'USER_DELETE';

    public function __construct(private Security $security)
    {
    }

    protected function supports($attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::USER_EDIT, self::USER_SHOW, self::USER_DELETE])
            && $subject instanceof User;
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
            self::USER_EDIT => $this->canEdit($user, $subject),
            self::USER_SHOW => $this->canEdit($user, $subject),
            default => false,
        };
    }

    public function canEdit(UserInterface $user, User $subject): bool
    {
        return $user === $subject;
    }
}
