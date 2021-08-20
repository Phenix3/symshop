<?php

namespace App\Admin\Controller;

use App\Admin\DataClass\PaymentMethodCrudData;
use App\Entity\GatewayConfig;
use App\Entity\PaymentMethod;
use Doctrine\ORM\EntityRepository;
use Payum\Core\Payum;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/payment-method", name="payment_method_")
 */
class PaymentMethodController extends CrudController
{
    protected string $templatePath = 'paymentMethod';
    protected string $menuItem = 'payment-method';
    protected string $entity = PaymentMethod::class;
    protected string $routePrefix = 'admin_payment_method';
    protected string $searchField = 'name';

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        /** @var EntityRepository $repo */
        $repo = $this->getRepository();
        $query = $repo->createQueryBuilder('row');
        return $this->crudIndex($query, 'name');
    }

    /**
     * @Route("/new/{factory}", name="new")
     */
    public function new(string $factory): Response
    {
        $gatewayConfig = new GatewayConfig();
        $gatewayConfig->setFactoryName($factory);
        $paymentMethod = new PaymentMethod();
        $paymentMethod->setGatewayConfig($gatewayConfig);
        $data = new PaymentMethodCrudData($paymentMethod);
        return $this->crudNew($data);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(PaymentMethod $paymentMethod): Response
    {
        return $this->crudDelete($paymentMethod);
    }

    /**
     * @Route("/{id}", name="edit")
     */
    public function edit(PaymentMethod $paymentMethod): Response
    {
        $data = new PaymentMethodCrudData($paymentMethod);

        return $this->crudEdit($data);
    }

    /**
     * @Route("gateways", name="gateways")
     *
     * @return void
     */
    public function getPaymentGateways(Payum $payum)
    {
        return $this->render('admin/paymentMethod/payment_gateways.html.twig', [
            'gatewayFactories' => $payum->getGatewayFactories()
        ]);
    }
}
