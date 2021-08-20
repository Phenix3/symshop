<?php

namespace App\Admin\Controller;

use App\Admin\DataClass\ReviewCrudData;
use App\Entity\Review;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/review", name="review_")
 */
class ReviewController extends CrudController
{
    protected string $templatePath = 'review';
    protected string $menuItem = 'review';
    protected string $entity = Review::class;
    protected string $routePrefix = 'admin_review';
    protected string $searchField = 'name';

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        /** @var EntityRepository $repo */
        $repo = $this->getRepository();
        $query = $repo
            ->createQueryBuilder('row')
            ->leftJoin('row.product', 'product')
            ->addSelect('product');

        return $this->crudIndex(
            $query
        );
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(): Response
    {
        $review = new Review();
        $data = new ReviewCrudData($review);

        return $this->crudNew($data);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Review $review): Response
    {
        return $this->crudDelete($review);
    }

    /**
     * @Route("/{id}", name="edit")
     */
    public function edit(Review $review): Response
    {
        $data = new ReviewCrudData($review);

        return $this->crudEdit($data);
    }
}
