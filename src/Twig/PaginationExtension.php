<?php

namespace App\Twig;

use Knp\Bundle\PaginatorBundle\Helper\Processor;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PaginationExtension extends AbstractExtension
{
    public $processor;

    public function __construct(Processor $processor)
    {
        $this->processor = $processor;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'paginate',
                [$this, 'render'],
                ['is_safe' => ['html'], 'needs_environment' => true]
            ),
        ];
    }

    public function render(Environment $twig, SlidingPagination $sliding, array $queryParams = [], array $viewParams = [])
    {
        return $twig
            ->render(
                $sliding->getTemplate(),
                $this->processor->render($sliding, $queryParams, $viewParams)
            );
    }
}
