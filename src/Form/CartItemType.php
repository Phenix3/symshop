<?php


namespace App\Form;
use App\Service\Cart\CartData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartItemType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('id', HiddenType::class)
      ->add('quantity', IntegerType::class, [
        'attr' => ['min' => 1],
        'label' => 'forms.quantity'
      ])
      ;
  }

  public function configureOptions(OptionsResolver $options)
  {
    $options->setDefaults([
      'data_class' => CartData::class,
    ]);
  }
}
