<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaV3Type;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrueV3;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rating', ChoiceType::class, [
                'choices' => $this->createReviewRating($options['rating_steps']),
                'expanded' => true,
                'multiple' => false
            ])
            ->add('comment', TextareaType::class)
            ->add('recaptcha', EWZRecaptchaV3Type::class, [
                'action_name' => 'review',
                'constraints' => [
                    new IsTrueV3()
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
            'rating_steps' => 5
        ]);
    }

    private function createReviewRating(int $maxRating): array
    {
        $ratings = [];
        for ($i = 1; $i <= $maxRating; $i++) {
            $ratings[$i] = $i;
        }

        return $ratings;
    }
}
