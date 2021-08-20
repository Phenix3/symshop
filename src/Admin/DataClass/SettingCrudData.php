<?php

declare(strict_types=1);

namespace App\Admin\DataClass;

// use App\Core\Validator\Slug;
use App\Entity\Setting;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @property Setting $entity
 */
class SettingCrudData extends AutomaticCrudData
{
    public string $keyName = '';

    public string $value = '';
}
