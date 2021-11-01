<?php

namespace App\Admin\Form;

use App\Admin\DataClass\ProductCrudData;
use App\Entity\Product;
use App\Form\Type\AttachmentType;
use App\Form\Type\CategoryChoiceType;
use App\Form\Type\MarkdownEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('slug', TextType::class)
            ->add('price', MoneyType::class)
            ->add('weight', NumberType::class)
            ->add('isActive', CheckboxType::class)
            ->add('quantity', NumberType::class)
            ->add('quantityAlert', NumberType::class)
            ->add('image', AttachmentType::class)
            ->add('images', CollectionType::class, [
                'entry_type' => AttachmentType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'block_name' => 'entry',
            ])
            ->add('description', MarkdownEditorType::class)
            ->add('metaKeywords')
            ->add('metaDescription')
            ->add('categories', CategoryChoiceType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductCrudData::class,
        ]);
    }
}
