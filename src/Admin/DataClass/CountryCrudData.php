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
     * @var string
     */
    public string $name = '';

    /**
     * @Assert\PositiveOrZero()
     * @var float
     */
    public float $tax = 0.0;

    /**
     * @Assert\Type(type="App\Entity\Range")
     * @var RangeValue|null
     */
    public ?RangeValue $rangeValue = null;

}
