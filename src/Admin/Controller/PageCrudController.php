<?php

namespace App\Admin\Controller;

use App\Admin\DataClass\PageCrudData;
use App\Entity\Page;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/page", name="page_")
 */
class PageCrudController extends CrudController
{
    protected string $entity = Page::class;
    protected string $templatePath = 'page';
    protected string $menuItem = 'page';
    protected string $routePrefix = 'admin_page';
    protected string $searchField = 'name';

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->crudIndex();
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Page $page): Response
    {
        $data = new PageCrudData($page);

        return $this->crudEdit($data);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(): Response
    {
        $page = new Page();
        $data = new PageCrudData($page);
        return $this->crudNew($data);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Page $page): RedirectResponse
    {
        return $this->crudDelete($page);
    }
}