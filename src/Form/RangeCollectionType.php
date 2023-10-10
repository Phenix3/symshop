<?php

namespace App\Form;

use App\Form\DataTransformer\RangeTransformer;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;

class RangeCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addModelTransformer(new CollectionToArrayTransformer(), true)
            ->addModelTransformer(new RangeTransformer(), true)
            ->add('ranges', CollectionType::class, [
                'entry_type' => RangeFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'label' => 'forms.range',
                'block_name' => 'entry',
                'entry_options' => [
                    'constraints' => [
                        new Valid()
                    ]
                ]
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
    }
}