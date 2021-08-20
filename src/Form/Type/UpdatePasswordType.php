<?php


namespace App\Form\Type;


use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UpdatePasswordType extends RepeatedType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $htmlAttrs = [
            'minLength' => 6,
            'maxLength' => 4096
        ];
        $resolver
            ->setDefaults([
                'type' => PasswordType::class,
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 6,
                        'max' => 4096
                    ])
                ],
                'first_options' => ['label' => false, 'attr' => array_merge($htmlAttrs, ['placeholder' => 'forms.new_password'])],
                'second_options' => ['label' => false, 'attr' => array_merge($htmlAttrs, ['placeholder' => 'forms.confirm_new_password'])],
            ]);
    }
}