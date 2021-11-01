<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaV3Type;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrueV3;

class CheckoutShippingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shipping', ChoiceType::class, [
                'choices' => [
                    'forms.colissimo' => 'colissimo',
                    'forms.withdrawal' => 'withdrawal',
                ],
                'expanded' => true 
            ])
            ->add('recaptcha', EWZRecaptchaV3Type::class, [
                'action_name' => 'checkout_shipping',
                'constraints' => [
                    new IsTrueV3()
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
