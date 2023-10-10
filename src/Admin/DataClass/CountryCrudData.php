<?php

declare(strict_types=1);

namespace App\Admin\DataClass;

//use App\Core\Validator\Slug;
use App\Entity\Country;
use App\Entity\RangeValue;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @property Country $entity
 */
class CountryCrudData extends AutomaticCrudData
{
    /**
     * @Assert\NotBlank()
     */
    public string $name = '';

    /**
     * @Assert\PositiveOrZero()
     */
    public float $tax = 0.0;

    /**
     * @Assert\Type(type="App\Entity\Range")
     */
    public ?RangeValue $rangeValue = null;

}
