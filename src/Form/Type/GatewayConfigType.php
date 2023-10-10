<?php

namespace App\Form\Type;

use App\Entity\GatewayConfig;
use Payum\Core\Model\GatewayConfigInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GatewayConfigType extends AbstractType
{
    private const configTypes = [
        'stripe_checkout' => StripeGatewayConfigType::class,
        'stripe_js' => StripeGatewayConfigType::class,
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                $gatewayConfig = $event->getData();
                $factoryName = $gatewayConfig->getFactoryName();

                if (!$gatewayConfig instanceof GatewayConfigInterface) {
                    return;
                }

                $form = $event->getForm();

                $form
                    ->add('factoryName', TextType::class, [
                        'label' => 'forms.gateway_config.type',
                        'disabled' => true,
                        'data' => $factoryName
                    ])
                    ->add('gatewayName', TextType::class, [
                        'label' => 'forms.gateway_config.gateway_name',
                        'data' => $factoryName
                    ]);

                $form->add('config', self::configTypes[$factoryName], [
                    'label' => false,
                    'auto_initialize' => false
                ]);
            })
            ;



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GatewayConfig::class
        ]);
    }
}