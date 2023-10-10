<?php

declare(strict_types=1);

namespace App\Admin\DataClass;

// use App\Core\Validator\Slug;

use App\Entity\GatewayConfig;
use App\Entity\PaymentMethod;

/**
 * @property PaymentMethod $entity
 */
class PaymentMethodCrudData extends AutomaticCrudData
{
    public string $name = '';

    public ?GatewayConfig $gatewayConfig = null;

    public string $description = '';

    public string $instructions = '';

    public bool $enabled = false;
}
