<?php


namespace App\Form\Type;


use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarkdownEditorType extends TextareaType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'html5' => false,
            'attr' => [
                'is' => 'markdown-editor'
            ]
        ]);
    }
}