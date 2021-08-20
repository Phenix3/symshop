<?php

namespace App\MessageHandler;

use App\Message\NewProductReviewMessage;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Message;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;

final class NewProductReviewMessageHandler implements MessageHandlerInterface
{
    /**
     * @var ParameterBagInterface
     */
    private ParameterBagInterface $parameterBag;
    /**
     * @var MailerInterface
     */
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer, ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
        $this->mailer = $mailer;
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
