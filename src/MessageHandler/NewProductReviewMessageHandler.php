<?php

namespace App\MessageHandler;

use App\Message\NewProductReviewMessage;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Address;

final class NewProductReviewMessageHandler implements MessageHandlerInterface
{
    public function __construct(private MailerInterface $mailer, private ParameterBagInterface $parameterBag)
    {
    }

    public function __invoke(NewProductReviewMessage $message)
    {

        $recipient = new Address($this->parameterBag->get('app.admin.email'));

        $email = (new TemplatedEmail())
            ->from(new Address('noreply@symshop.com', 'SymShop Mail Bot'))
            ->to($recipient)
            ->subject('New product review!')
            ->htmlTemplate('email/new_product_review.html.twig')
        ;

        $context = $email->getContext();
        $context['product'] = $message->getProduct();
        $context['review'] = $message->getReview();

        $email->context($context);

        $this->mailer->send($email);
    }
}
