<?php

declare(strict_types=1);

namespace App\Admin\DataClass;

// use App\Core\Validator\Slug;
use App\Entity\Product;
use App\Entity\Review;
use App\Entity\User;
use App\Form\Type\StatusChoiceType;

/**
 * @property Review $entity
 */
class ReviewCrudData extends AutomaticCrudData
{
    public ?int $rating = 0;

    public string $comment = '';

    public ?User $author = null;

    public ?Product $product = null;

    public ?string $status = StatusChoiceType::STATUS['pending'];
}
