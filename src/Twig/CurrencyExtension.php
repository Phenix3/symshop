<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare (strict_types = 1);

namespace App\Twig;

use App\Templating\Helper\CurrencyHelperInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class CurrencyExtension // extends AbstractExtension
{
    /** @var CurrencyHelperInterface */
    private $helper;

    public function __construct(CurrencyHelperInterface $helper)
    {
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('shop_currency_symbol', [$this->helper, 'convertCurrencyCodeToSymbol']),
        ];
    }
}
