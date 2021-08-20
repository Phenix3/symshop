<?php


namespace App\Core\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Unique extends Constraint
{
    public string $message = 'This value is already used.';

    public ?string $entityClass = null;

    public string $field = '';

    public function getRequiredOptions()
    {
        return ['field'];
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}