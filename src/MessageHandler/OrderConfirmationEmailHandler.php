<?php

namespace App\MessageHandler;

use App\Message\OrderConfirmationEmail;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Address;

final class OrderConfirmationEmailHandler implements MessageHandlerInterface
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function __invoke(OrderConfirmationEmail $message)
    {
        $order = $message->getOrder();
        $user = $order->getUser();
        $email = (new TemplatedEmail())
            ->from(new Address('noreply@symshop.com', 'SymShop Mail Bot'))
            ->to(new Address($user->getEmail(), $user->getUsername()))
            ->subject('Please confirm your order!')
            ->htmlTemplate('order/confirmation_email.html.twig')
            ;

        $context = $email->getContext();
        $context['order'] = $order;
        $email->context($context);

        $this->mailer->send($email);
    }
}
