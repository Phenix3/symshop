<?php

namespace App\Form\Type;

use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $formEvent) {
            $form = $formEvent->getForm();
            $payment = $formEvent->getData();

            $form->add('method', PaymentMethodChoiceType::class, [
                'label' => 'forms.checkout.payment_method',
                'subject' => $payment,
                'expanded' => true
            ]);
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Payment::class
        ]);
    }
}