<?php


namespace App\Form\Type;


use Exception;
use App\Entity\Attachment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class AttachmentType extends TextType implements DataTransformerInterface
{

    public function __construct(private EntityManagerInterface $entityManager, private UploaderHelper $uploaderHelper)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addViewTransformer($this)
            ;
        parent::buildForm($builder, $options);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (null !== $form->getData()) {
            $view->vars['attr']['preview'] = $this->uploaderHelper->asset($form->getData());
        }
        $view->vars['attr']['overwrite'] = true;
        parent::buildView($view, $form, $options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'required' => false,
                'attr' => [
                    'is' => 'input-attachment'
                ],
                'row_attr' => [
                    'style' => "width: 200px"
                ]
            ]);
        parent::configureOptions($resolver);
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function transform($value): ?string
    {
        if ($value instanceof Attachment) {
            return $value->getId();
        }
        return null;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function reverseTransform($value): ?Attachment
    {
        if (empty($value)) {
            return null;
        }

        return $this->entityManager->getRepository(Attachment::class)->find($value) ?: new Exception('Not found Attachment ');
    }
}