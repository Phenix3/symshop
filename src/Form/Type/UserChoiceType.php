<?php

namespace App\Form\Type;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserChoiceType extends AbstractType implements DataTransformerInterface
{
    public function __construct(private EntityManagerInterface $em, private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addViewTransformer($this);
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $choices = [];
        $user = $form->getData();
        if ($user instanceof User) {
            $choices = [new ChoiceView($user, (string) $user->getId(), $user->getUsername())];
        }
        $view->vars['choice_translation_domain'] = false;
        $view->vars['expanded'] = false;
        $view->vars['placeholder'] = null;
        $view->vars['placeholder_in_choices'] = false;
        $view->vars['multiple'] = false;
        $view->vars['preferred_choices'] = [];
        $view->vars['value'] = $user ? $user->getId() : 0;
        $view->vars['choices'] = $choices;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'compound' => false,
                'attr' => [
                    'is' => 'user-select',
                    'endpoint' => $this->urlGenerator->generate('admin_user_autocomplete')
                ]
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'choice';
    }

    /**
     * Undocumented function
     *
     * @param ?User $user
     */
    public function transform($user): string
    {
        return null === $user ? '' : (string) $user->getId();
    }

    public function reverseTransform($userId): ?User
    {
        return $this->em->getRepository(User::class)->find($userId);
    }
}