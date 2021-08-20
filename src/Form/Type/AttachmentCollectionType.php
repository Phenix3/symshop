<?php


namespace App\Form\Type;


use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttachmentCollectionType extends CollectionType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'entry_type' => AttachmentType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
        ]);
    }
}