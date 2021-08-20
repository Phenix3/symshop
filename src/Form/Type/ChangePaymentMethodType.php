<?php

namespace App\Form\Type;

use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ChangePaymentMethodType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
            $payments = $event->getData();
            $form = $event->getForm();

            foreach ($payments as $key => $payment) {
                if (!in_array($payment->getState(), [Payment::STATE_NEW, Payment::STATE_CART])) {
                    $form->remove($key);
                }
            }
        });
    }

    public function getParent(): string
    {
        return CollectionType::class;
    }
    
}