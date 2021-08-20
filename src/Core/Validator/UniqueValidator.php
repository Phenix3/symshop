<?php


namespace App\Core\Validator;


use App\Admin\DataClass\CrudDataInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueValidator extends ConstraintValidator
{

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($obj, Constraint $constraint)
    {
        if (null === $obj) {
            return;
        }

        if (!$constraint instanceof Unique) {
            throw new \RuntimeException(sprintf("%s can't validate constraints %s", self::class, get_class($constraint)));
        }

        if (!method_exists($obj, 'getId')) {
            throw new \RuntimeException(sprintf("%s can't be used to object %s, he dont has the \"getId\"", self::class,get_class($obj)));
        }

        $accessor = new PropertyAccessor();

        /** @var class-string<\stdClass> $entityClass */
        $entityClass = $constraint->entityClass;

        if ($obj instanceof CrudDataInterface) {
            $entityClass = get_class($obj->getEntity());
        }
        $value = $accessor->getValue($obj, $constraint->field);
        $repository = $this->entityManager->getRepository($entityClass);
        $result = $repository->findOneBy([$constraint->field => $value]);

        if (
            null !== $result
            && (!method_exists($result, 'getId') || $result->getId() !== $obj->getId())
        ) {
            $this->context->buildViolation($constraint->message)
                ->atPath($constraint->field)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}