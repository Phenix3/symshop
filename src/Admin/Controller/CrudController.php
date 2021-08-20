<?php

namespace App\Admin\Controller;

use App\Admin\DataClass\CrudDataInterface;
use App\Core\Paginator\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

abstract class CrudController extends BaseController
{
    protected string $entity;
    protected string $templatePath = '';
    protected string $menuItem = '';
    protected string $routePrefix = '';
    protected string $searchField = 'name';

    protected array $events = [
        'create' => null,
        'update' => null,
        'delete' => null,
    ];

    protected EntityManagerInterface $em;
    protected PaginatorInterface $paginator;
    protected EventDispatcherInterface $eventDispatcher;
    private RequestStack $requestStack;

    public function __construct(
        EntityManagerInterface $em,
        EventDispatcherInterface $eventDispatcher,
        RequestStack $requestStack,
        PaginatorInterface $paginator
    ) {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
        $this->requestStack = $requestStack;
        $this->paginator = $paginator;
    }

    public function crudIndex(QueryBuilder $query = null, string $orderBy = 'createdAt'): Response
    {
        $request = $this->requestStack->getCurrentRequest();
        /** @var EntityRepository $repo */
        $repo = $this->getRepository();
        $query = $query ?: $repo
            ->createQueryBuilder('row')
            ->orderBy("row.{$orderBy}", 'DESC');

        if ($request->get('q')) {
            $query = $this->applySearch($request->get('q'), $query);
        }

        $this->paginator->allowSort('row.id', 'row.name');
        $rows = $this->paginator->paginate($query->getQuery());

        return $this->render("admin/{$this->templatePath}/index.html.twig", [
            'rows' => $rows,
            'searchable' => true,
            'menu' => $this->menuItem,
            'prefix' => $this->routePrefix,
        ]);
    }

    public function crudEdit(CrudDataInterface $data): Response
    {
        $request = $this->requestStack->getCurrentRequest();
        $form = $this->createForm($data->getFormClass(), $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $data->getEntity();
            $old = clone $entity;
            $data->hydrate();
            $this->em->flush();
            
            if ($this->events['update'] ?? null) {
                $this->eventDispatcher->dispatch(new $this->events['update']($entity, $old));
            }

            $this->addFlash(
                'success',
                'alerts.content_updated'
            );

            return $this->redirectToRoute($this->routePrefix . '_index');
        }

        return $this->render("admin/{$this->templatePath}/edit.html.twig",[
            'form' => $form->createView(),
            'entity' => $data->getEntity(),
            'menu' => $this->menuItem
        ]);

    }


    public function crudNew(CrudDataInterface $data): Response
    {
        $request = $this->requestStack->getCurrentRequest();
        $form = $this->createForm($data->getFormClass(), $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $data->getEntity();
            $data->hydrate();
            $this->em->persist($entity);
            $this->em->flush();

            if ($this->events['create'] ?? null) {
                $this->eventDispatcher->dispatch(new $this->events['create']($data->getEntity()));
            }

            $this->addFlash(
                'success',
                'alerts.content_created'
            );

            return $this->redirectToRoute($this->routePrefix . '_edit', ['id' => $entity->getId()]);
        }

        return $this->render("admin/{$this->templatePath}/new.html.twig",[
            'form' => $form->createView(),
            'entity' => $data->getEntity(),
            'menu' => $this->menuItem
        ]);

    }

    public function crudDelete(object $entity, ?string $redirectRoute = null): RedirectResponse
    {
        dump($entity);
        $this->em->remove($entity);
        if ($this->events['delete'] ?? null) {
            $this->eventDispatcher->dispatch(new $this->events['delete']($entity));
        }
        dump($entity);
        $this->em->flush();
        $this->addFlash(
        'success',
        'alerts.content_deleted'
        );

        return $this->redirectToRoute($redirectRoute ?: ($this->routePrefix.'_index'));
    }



    protected function getRepository(): ObjectRepository
    {
        return $this->em->getRepository($this->entity);
    }

    protected function applySearch(string $search, QueryBuilder $query): QueryBuilder
    {
        return $query
            ->where("LOWER(row.{$this->searchField}) LIKE :search")
            ->setParameter('search', '%' . \strtolower($search) . '%');
    }
}
