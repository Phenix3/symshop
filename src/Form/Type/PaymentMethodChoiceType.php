<?php

namespace App\Form\Type;

use App\Entity\Payment;
use App\Repository\PaymentMethodRepository;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentMethodChoiceType extends AbstractType
{
    private PaymentMethodRepository $paymentMethodRepository;

    public function __construct(PaymentMethodRepository $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => function(Options $options) {
                return $this->paymentMethodRepository->findBy(['enabled' => true]);
            },
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