<?php

namespace App\Form;

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaV3Type;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrueV3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'forms.name',
                'mapped' => false,
                'constraints' => [
                    new NotBlank
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'forms.email',
                'mapped' => false,
                'constraints' => [
                    new NotBlank,
                    new Email
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'forms.message',
                'mapped' => false,
                'constraints' => [
                    new NotBlank,
                    new Length([
                        'min' => 20
                    ])
                ]
            ])
            ->add('recaptcha', EWZRecaptchaV3Type::class, [
                'action_name' => 'contact',
                'constraints' => [
                    new IsTrueV3()
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
