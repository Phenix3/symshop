<?php

namespace App\Form;

use App\DataClass\SearchData;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchDataType extends AbstractType
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $aoptions)
    {
        $builder
            ->add('q', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'forms.search'
                ],
                'required' => false
            ])
            ->add('min', NumberType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'forms.min_price'
                ]
            ])
            ->add('max', NumberType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'forms.max_price'
                ]
            ])
            ->add('categories', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => Category::class,
                'multiple' => true,
                'expanded' => true,
                'query_builder' => $this->categoryRepository->findForSearchBuilder(),
                'choice_value' => 'slug'
            ])
            ->add('page', HiddenType::class, [
                'required' => false
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'csrf_protection' => false,
            'method' => 'GET'
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}