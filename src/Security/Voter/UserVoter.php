<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{

    const USER_EDIT = 'USER_EDIT';
    const USER_SHOW = 'USER_SHOW';
    const USER_DELETE = 'USER_DELETE';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::USER_EDIT, self::USER_SHOW, self::USER_DELETE])
            && $subject instanceof User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::USER_EDIT:
                return $this->canEdit($user, $subject);
                break;
            case self::USER_SHOW:
                return $this->canEdit($user, $subject);
                break;
        }

        return false;
    }

    public function canEdit(UserInterface $user, User $subject): bool
    {
        return $user === $subject;
    }
}
