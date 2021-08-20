<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class StripeGatewayConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('publishable_key', TextType::class, [
                'label' => 'forms.stripe.publishable_key',
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('secret_key', TextType::class, [
                'label' => 'forms.stripe.secret_key',
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ;
    }
}