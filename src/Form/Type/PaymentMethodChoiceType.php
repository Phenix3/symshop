<?php

namespace App\Form\Type;

use App\Repository\PaymentMethodRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentMethodChoiceType extends AbstractType
{
    public function __construct(private PaymentMethodRepository $paymentMethodRepository)
    {
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => fn(Options $options) => $this->paymentMethodRepository->findBy(['enabled' => true]),
            'choice_value' => 'id',
            'choice_label' => 'name'
        ])
        ;
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}