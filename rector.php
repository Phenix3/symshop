<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/config',
        __DIR__ . '/lib',
        __DIR__ . '/migrations',
        __DIR__ . '/public',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

	$rectorConfig->sets([
        SetList::CODE_QUALITY
    ]);

    // register single rule
    $rectorConfig->rule(TypedPropertyRector::class);

    // define sets of rules
    //    $rectorConfig->sets([
    //        LevelSetList::UP_TO_PHP_74
    //    ]);
};
