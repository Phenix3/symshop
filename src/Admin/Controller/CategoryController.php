<?php

namespace App\Admin\Controller;

use App\Admin\Event\Category\CategoryCreated;
use App\Admin\Event\Category\CategoryUpdated;
use App\Entity\Category;
use App\Admin\DataClass\CategoryCrudData;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", name="category_")
 */
class CategoryController extends CrudController
{
    protected string $templatePath = 'category';
    protected string $menuItem = 'category';
    protected string $entity = Category::class;
    protected string $routePrefix = 'admin_category';
    protected string $searchField = 'name';

    protected array $events = [
        'create' => CategoryCreated::class,
        'update' => CategoryUpdated::class
    ];

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->crudIndex(
            $this->getRepository()->createQueryBuilder('row'), 'name'
        );
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(): Response
    {
        $category = new Category();
        $data = new CategoryCrudData($category);

        return $this->crudNew($data);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Category $category): Response
    {
        return $this->crudDelete($category);
    }

    /**
     * @Route("/{id}", name="edit")
     */
    public function edit(Category $category): Response
    {
        $data = new CategoryCrudData($category);

        return $this->crudEdit($data);
    }
}
