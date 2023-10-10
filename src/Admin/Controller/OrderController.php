<?php

namespace App\Admin\Controller;

use App\Admin\DataClass\OrderCrudData;
use App\Entity\Order;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/order", name="order_")
 */
class OrderController extends CrudController
{
    protected string $templatePath = 'order';
    protected string $menuItem = 'order';
    protected string $entity = Order::class;
    protected string $routePrefix = 'admin_order';
    protected string $searchField = 'name';

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        /** @var EntityRepository $repo */
        $repo = $this->getRepository();
        $query = $repo->createQueryBuilder('row')->join('row.user', 'user')->addSelect('user');
        return $this->crudIndex($query);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @Entity("repository.findForShow(id)")
     */
    public function show(Order $order): Response
    {

        return $this->render('admin/order/show.html.twig', ['order' => $order]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Order $order): Response
    {
        return $this->crudDelete($order);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Order $order): Response
    {
        $data = new OrderCrudData($order);

        return $this->crudEdit($data);
    }
}
