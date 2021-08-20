<?php


namespace App\Form\Type;

use App\Form\CartItemType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

class CartCollectionType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('items', CollectionType::class, [
                'entry_type' => CartItemType::class,
                'allow_add' => false,
                'allow_delete' => false
            ])
            ;
    }

}