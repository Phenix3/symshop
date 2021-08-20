<?php

namespace App\Core\Paginator;

use Doctrine\ORM\Query;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface PaginatorInterface
{
    public function paginate(Query $query): PaginationInterface;

    public function allowSort(string ...$fields): self;
}