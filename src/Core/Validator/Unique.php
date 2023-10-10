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

    public function getRequiredOptions(): array
    {
        return ['field'];
    }

    public function getTargets(): string|array
    {
        return self::CLASS_CONSTRAINT;
    }
}