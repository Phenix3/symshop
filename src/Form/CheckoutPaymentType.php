<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Payment;
use App\Form\Type\PaymentType;
use Symfony\Component\Form\AbstractType;
use App\Form\Type\ChangePaymentMethodType;
use App\Form\Type\PaymentMethodChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaV3Type;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrueV3;

class CheckoutPaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('method', PaymentMethodChoiceType::class, [
                // 'entry_type' => PaymentType::class,
                'expanded' =>true
            ])
            ->add('recaptcha', EWZRecaptchaV3Type::class, [
                'action_name' => 'checkout_payment',
                'constraints' => [
                    new IsTrueV3()
                ]
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
