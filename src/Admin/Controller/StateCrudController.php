<?php

namespace App\Admin\Controller;

use App\Admin\DataClass\StateCrudData;
use App\Entity\State;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/state", name="state_")
 */
class StateCrudController extends CrudController
{
    protected string $entity = State::class;
    protected string $templatePath = 'state';
    protected string $menuItem = 'state';
    protected string $searchField = 'name';
    protected string $routePrefix = 'admin_state';


    /**
     * @Route("/", name="index", methods={"GET"})
     *
     * @return Response
     */
    public function index(): Response
    {
        /** @var EntityRepository $repo */
        $repo = $this->getRepository();
        return parent::crudIndex($repo->createQueryBuilder('row'));
    }

    /**
     * @Route("/new", name="new")
     *
     * @return Response
     */
    public function new(): Response
    {
        $state = new State();
        $data = new StateCrudData($state);

        return $this->crudNew($data);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"POST", "GET"})
     */
    public function edit(State $state)
    {
        $data = new StateCrudData($state);

        return $this->crudEdit($data);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     *
     * @param State $state
     * @return RedirectResponse
     */
    public function delete(State $state): RedirectResponse
    {
        return $this->crudDelete($state);
    }
}
