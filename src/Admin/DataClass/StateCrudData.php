<?php

namespace App\Admin\DataClass;

use App\Entity\State;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @property State $entity
 */
class StateCrudData extends AutomaticCrudData
{
    /**
     * Undocumented variable
     *
     *
     * @Assert\NotBlank
     */
    public string $name = '';

    /**
     *
     */
    public ?string $slug = '';

    /**
     * Undocumented variable
     *
     *
     * @Assert\NotBlank
     */
    public string $color = '';

    /**
     * Undocumented variable
     *
     */
    public ?int $indice = 0;

    public function hydrate(): void
    {
        parent::hydrate();
        // $this->entity->setUpdatedAt(new \DateTimeImmutable());
    }
}
