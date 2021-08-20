<?php

declare(strict_types=1);

namespace App\Admin\DataClass;

// use App\Core\Validator\Slug;
use App\Core\Validator\Unique;
use App\Entity\Attachment;
use App\Entity\Product;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @property Product $entity
 *
 * @Unique(field="name")
 */
class ProductCrudData extends AutomaticCrudData
{
    /**
     * @Assert\NotBlank
     */
    public string $name = '';

    public string $slug = '';

    /**
     * @Assert\NotBlank
     * @Assert\Positive()
     */
    public float $price = 0.0;

    /**
     * @Assert\NotBlank
     * @Assert\Positive()
     */
    public float $weight = 0.0;

    /**
     *
     */
    public bool $isActive = false;

    /**
     * @Assert\NotBlank
     * @Assert\Positive()
     */
    public int $quantity = 0;

    /**
     * @Assert\NotBlank
     * @Assert\Positive()
     */
    public int $quantityAlert = 10;

    /**
     */
    public ?Attachment $image = null;

    public ?Collection $images = null;

    public ?Collection $categories = null;

    /**Persistent
     */
    public string $description;

    /**
     */
    public ?string $metaKeywords = '';

    /**
     */
    public ?string $metaDescription = '';

/*
    public function getFormClass(): string
    {
        return ProductType::class;
    }*/
}
