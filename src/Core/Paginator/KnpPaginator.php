<?php


namespace App\Core\Paginator;

use Doctrine\ORM\Query;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\HttpFoundation\RequestStack;


class KnpPaginator implements PaginatorInterface
{
    private $paginator;
    private $requestStack;

    private $sortableFields = [];

    public function __construct(
        \Knp\Component\Pager\PaginatorInterface $paginator,
        RequestStack $requestStack
    ) {
        $this->paginator = $paginator;
        $this->requestStack = $requestStack;
    }

    public function paginate(Query $query): PaginationInterface
    {
        $request = $this->requestStack->getCurrentRequest();
        $page = $request ? $request->query->getInt('page', 1) : 1;

        if ($page <= 0) {
            throw new \Exception();
        }

        return $this->paginator->paginate($query, $page, $query->getMaxResults() ?: 15, [
            'sortFieldWhiteList' => $this->sortableFields,
            'filterFieldWhiteList' => []
        ]);
    }

    public function allowSort(string ...$fields): self
    {
        $this->sortableFields = \array_merge($this->sortableFields, $fields);

        return $this;
    }
}