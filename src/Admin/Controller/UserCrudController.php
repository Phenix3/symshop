<?php

namespace App\Admin\Controller;

use App\Admin\DataClass\CrudDataInterface;
use App\Admin\Event\User\UserCreatedEvent;
use App\Admin\Event\User\UserDeletedEvent;
use App\Entity\User;
use App\Admin\DataClass\UserCrudData;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", name="user_")
 */
class UserCrudController extends CrudController
{
    protected string $entity = User::class;
    protected string $templatePath = 'user';
    protected string $menuItem = 'user';
    protected string $routePrefix = 'admin_user';
    protected string $searchField = 'username';
    protected array $events = [
        'create' => UserCreatedEvent::class,
        'delete' => UserDeletedEvent::class
    ];

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $query = $this
            ->getRepository()
            ->createQueryBuilder('row')
            ->leftJoin('row.image', 'image')
            ->addSelect('image');
        return $this->crudIndex($query);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(): Response
    {
        $user = new User();
        $data = new UserCrudData($user);

        return $this->crudNew($data);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     *
     * @param CrudDataInterface $data
     */
    public function edit(User $user): Response
    {
        $data = new UserCrudData($user);
        return $this->crudEdit($data);
    }

    /**
     * @Route("/search/{q?}", name="autocomplete")
     */
    public function search(string $q): JsonResponse
    {
        /** @var UserRepository $repository */
        $repository = $this->getRepository();
        $q = \mb_strtolower($q);
        if ('moi' === $q) {
            return $this->json([
                [
                    'id' => $this->getUser()->getId(),
                    'username' => $this->getUser()->getUsername(),
                ],
            ]);
        }

        $users = $repository->createQueryBuilder('u')
            ->select('u.id', 'u.username')
            ->where('LOWER(u.username) LIKE :username')
            ->setParameter('username', "%{$q}%")
            ->setMaxResults(25)
            ->getQuery()
            ->getResult();

        return $this->json($users);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(User $user): RedirectResponse
    {
        return $this->crudDelete($user);
    }
}
