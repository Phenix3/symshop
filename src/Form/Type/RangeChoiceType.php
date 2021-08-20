<?php


namespace App\Form\Type;


use App\Entity\RangeValue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RangeChoiceType extends EntityType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver
            ->setDefaults([
                'class' => RangeValue::class
            ]);
    }
}