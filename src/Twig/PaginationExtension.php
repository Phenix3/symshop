<?php

namespace App\Twig;

use Knp\Bundle\PaginatorBundle\Helper\Processor;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PaginationExtension extends AbstractExtension
{
    public function __construct(public Processor $processor)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'paginate',
                fn(Environment $twig, SlidingPagination $sliding, array $queryParams = [], array $viewParams = []) => $this->render($twig, $sliding, $queryParams, $viewParams),
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
