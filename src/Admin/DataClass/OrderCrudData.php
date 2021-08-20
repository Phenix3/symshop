<?php

declare(strict_types=1);

namespace App\Admin\DataClass;

// use App\Core\Validator\Slug;
use App\Entity\Order;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @property Order $entity
 */
class OrderCrudData extends AutomaticCrudData
{
}
