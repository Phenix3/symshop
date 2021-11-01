<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Address;
use Webmozart\Assert\Assert;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use App\Service\Address\AddressComparator;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaV3Type;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrueV3;

class CheckoutAddressType extends AbstractType
{
    public $addressComaprator;
    
    public function __construct(Security $security, ?AddressComparator $addressComaprator)
    {
        $this->security = $security;
        $this->addressComaprator = $addressComaprator;
    }


    public function buildForm(FormBuilderInterface $builder, array $optins)
    {
        $builder
            ->add('recaptcha', EWZRecaptchaV3Type::class, [
                'action_name' => 'checkout_address',
                'constraints' => [
                    new IsTrueV3()
                ]
            ])
            ->add('differentBillingAddress', CheckboxType::class, [
                'label' => 'forms.different_billing_address',
                'required' => false,
                'mapped' => false,
            ])
            ->add('differentShippingAddress', CheckboxType::class, [
                'label' => 'forms.different_shipping_address',
                'required' => false,
                'mapped' => false,
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                $form = $event->getForm();
                $form
                    ->add('shippingAddress', AddressType::class, [
                        'constraints' => [new Valid()],
                    ])
                    ->add('billingAddress', AddressType::class, [
                        'constraints' => [new Valid()]
                    ])
                    ;
            })
            ->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event)  {
                $form = $event->getForm();
                Assert::isInstanceOf($event->getData(), Order::class);

                /** @var Order $order */
                $order = $event->getData();
                $areAddressDifferent = $this->areAddressDifferent($order->getBillingAddress(), $order->getShippingAddress());

                $form->get('differentBillingAddress')->setData($areAddressDifferent);
                $form->get('differentShippingAddress')->setData($areAddressDifferent);
            })
            ->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) {
                /** @var Order $orderData */
                $orderData = $event->getData();

                
                $differentBillingAddress = $orderData['differentBillingAddress'] ?? false;
                $differentShippingAddress = $orderData['differentShippingAddress'] ?? false;

                if (isset($orderData['billingAddress']) && !$differentBillingAddress && !$differentShippingAddress) {
                    $orderData['shippingAddress'] = $orderData['billingAddress'];
                }

                if (isset($orderData['shippingAddress']) && !$differentBillingAddress && !$differentShippingAddress) {
                    $orderData['billingAddress'] = $orderData['shippingAddress'];
                }

                $event->setData($orderData);
            })
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Order::class
            ]);
    }

    private function areAddressDifferent(?Address $firstAddress, ?Address $secondAddress): bool
    {
        if (null == $this->addressComaprator || null == $firstAddress || null == $secondAddress) {
            return false;
        }

        return $this->addressComaprator->equal($firstAddress, $secondAddress);
    }
}