<?php


namespace App\Admin\Form;


use App\Admin\DataClass\CategoryCrudData;
use App\Entity\Category;
use App\Form\Type\SwitchType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('slug', TextType::class, [
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'required' => false
            ])
            ->add('parent', EntityType::class, [
                'class' => Category::class,
                'placeholder' => 'labels.choice_category',
                'required' => false
            ])
            ->add('enabled', SwitchType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'data_class' => CategoryCrudData::class
            ]);
    }
}