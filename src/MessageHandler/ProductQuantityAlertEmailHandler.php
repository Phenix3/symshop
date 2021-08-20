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
    private $mailer;
    private $parameterBag;

    public function __construct(MailerInterface $mailer, ParameterBagInterface $parameterBag)
    {
        $this->mailer = $mailer;
        $this->parameterBag = $parameterBag;
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
