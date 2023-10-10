<?php

namespace App\MessageHandler;

use App\Message\ProductQuantityAlertEmail;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Address;

final class ProductQuantityAlertEmailHandler implements MessageHandlerInterface
{
    public function __construct(private MailerInterface $mailer, private ParameterBagInterface $parameterBag)
    {
    }

    public function __invoke(ProductQuantityAlertEmail $message)
    {
        $product = $message->getProduct();

        $email = (new TemplatedEmail())
            ->from(new Address('noreply@symshop.com', 'Symshop Mail Bot'))
            ->to($this->parameterBag->get('app.admin.email'))
            ->subject('Alert products!')
            ->htmlTemplate('email/product_quantity_alert_email.html.twig')
            ;
        $context = $email->getContext();
        $context['product'] = $product;
        $email->context($context);

        $this->mailer->send($email);
    }
}
