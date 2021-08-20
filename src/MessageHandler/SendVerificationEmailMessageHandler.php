<?php

namespace App\MessageHandler;

use App\Message\SendVerificationEmailMessage;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Address;

final class SendVerificationEmailMessageHandler implements MessageHandlerInterface
{
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    public function __invoke(SendVerificationEmailMessage $message)
    {
        $user = $message->getUser();
        $this->emailVerifier->sendEmailConfirmation('shop_verify_email', $user,
            (new TemplatedEmail())
                ->from(new Address('noreply@symshop.com', 'SymShop Mail Bot'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
        );
    }
}
