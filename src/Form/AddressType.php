<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Country;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isProfessionnal', CheckboxType::class, [
                'required' => false,
                'label' => 'forms.is_professionnal'
            ])
            ->add('civility', ChoiceType::class, [
                'choices' => [
                    'forms.select_civility' => null,
                    'forms.civility_m' => 'M.',
                    'forms.civility_mme' => 'Mme.'
                ],
                'label' => 'forms.civility',
                'expanded' => $options['expanded_civility']
            ])
            ->add('name', TextType::class, [
                'label' => 'forms.name',
                'required' => false
            ])
            ->add('firstName', TextType::class, [
                'label' => 'forms.first_name',
                'required' => false
            ])
            ->add('company', TextType::class, [
                'label' => 'forms.company',
                'required' => false
            ])
            ->add('address', TextType::class, [
                'label' => 'forms.address'
            ])
            ->add('addressbis', TextType::class, [
                'label' => 'forms.addressbis',
                'required' => false
            ])
            ->add('bp', TextType::class, [
                'label' => 'forms.bp',
                'required' => false
            ])
            ->add('postal', TextType::class, [
                'label' => 'forms.postal'
            ])
            ->add('city', TextType::class, [
                'label' => 'forms.city'
            ])
            ->add('phone', TelType::class, [
                'label' => 'forms.phone'
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'name',
                'placeholder' => 'forms.select_country',
                'label' => 'forms.country'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
            'expanded_civility' => true
        ])
        ->setAllowedTypes('expanded_civility', 'bool')
        ;
    }
}
