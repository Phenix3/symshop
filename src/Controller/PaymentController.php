<?php

namespace App\Controller;

use App\Entity\Order;
use Payum\Core\Payum;
use Payum\Core\Request\GetHumanStatus;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    /**
     * @var Payum
     */
    private Payum $payum;

    public function __construct(Payum $payum)
    {
        $this->payum = $payum;
    }

    /**
     * @Route("/payment", name="payment")
     * 
     * @param Request $request
     */
     public function prepare(Request $request)
    {
        $token = $this->payum->getHttpRequestVerifier()->verify($request);
        $gateway = $this->payum->getGateway($token->getGatewayName());

        $this->payum->getHttpRequestVerifier()->invalidate($token);

        //
        $gateway->execute($status = new GetHumanStatus($token));
        $payment = $status->getFirstModel();

        return $this->json([
            'status' => $status->getValue(),
            'payment' => [
                'total_amount' => $payment->getTotalAmount(),
                'currency_code' => $payment->getCurrencyCode(),
                'details' => $payment->getDetails()
            ]
        ]);
    }

}
