<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Payment;
use App\Form\Type\ChangePaymentMethodType;
use App\Form\Type\PaymentMethodChoiceType;
use App\Form\Type\PaymentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckoutPaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('method', PaymentMethodChoiceType::class, [
                // 'entry_type' => PaymentType::class,
                'expanded' =>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
        ]);
    }
}
