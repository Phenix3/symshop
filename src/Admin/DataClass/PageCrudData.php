<?php

namespace App\Admin\DataClass;

use App\Entity\Page;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @property Page $entity
 */
class PageCrudData extends AutomaticCrudData
{
    /**
     * @Assert\NotBlank
     */
    public string $name = '';

    public ?string $slug = '';

    /**
     * @Assert\NotBlank()
     */
    public string $content = '';
}