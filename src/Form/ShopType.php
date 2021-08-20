<?php

namespace App\Form;

use App\Entity\Shop;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('holder')
            ->add('email')
            ->add('bic')
            ->add('iban')
            ->add('bank')
            ->add('bankAddress')
            ->add('phone')
            ->add('facebook')
            ->add('home')
            ->add('homeInfos')
            ->add('homeShipping')
            ->add('hasInvoice')
            ->add('hasCard')
            ->add('hasTransfer')
            ->add('hasCheck')
            ->add('hasMandat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shop::class,
        ]);
    }
}
