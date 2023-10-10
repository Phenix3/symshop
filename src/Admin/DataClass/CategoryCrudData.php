<?php

declare(strict_types=1);

namespace App\Admin\DataClass;

// use App\Core\Validator\Slug;
use App\Admin\Form\CategoryForm;
use App\Entity\Category;
use Symfony\Component\Validator\Constraints as Assert;
use App\Core\Validator\Unique;

/**
 * @property Category $entity
 *
 * @Unique(field="name")
 */
class CategoryCrudData extends AutomaticCrudData
{
    /**
     * @Assert\NotBlank()
     */
    public string $name = '';

    public ?string $slug = '';

    public ?string $description = '';

    public ?Category $parent = null;

    public bool $enabled = true;

    public function getFormClass(): string
    {
        return CategoryForm::class;
    }
}
