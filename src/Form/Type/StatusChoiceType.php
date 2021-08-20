<?php


namespace App\Form\Type;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatusChoiceType extends ChoiceType
{
    public const STATUS = [
        'pending' => 'PENDING',
        'accepted' => 'ACCEPTED',
        'rejected' => 'REJECTED'
    ];


    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver
            ->setDefaults([
                'choices' => self::STATUS
            ]);
    }

}