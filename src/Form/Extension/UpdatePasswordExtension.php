<?php


namespace App\Form\Extension;


use App\Form\ChangePasswordFormType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class UpdatePasswordExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'mapped' => false,
                'constraints' => [
                    new UserPassword()
                ],
                'label' => 'forms.current_password'
            ]);
    }

    /**
     * @return iterable|string[]
     */
    public static function getExtendedTypes(): iterable
    {
        return [
            ChangePasswordFormType::class,
        ];
    }
}