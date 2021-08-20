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

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(new CollectionToArrayTransformer());
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => function(Options $options) {
                if ($options['subject']) {
                    return $this->paymentMethodRepository->findBy(['enabled' => true]);
                }

                return $this->paymentMethodRepository->findAll();
            },
            'choice_value' => 'id',
            'choice_label' => 'name'
        ])
        ->setDefined([
            'subject'
        ])
        ->setAllowedTypes('subject', Payment::class)
        ;
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}