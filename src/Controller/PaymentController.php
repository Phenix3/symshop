<?php

namespace App\Controller;

use Payum\Core\Payum;
use Payum\Core\Request\GetHumanStatus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    public function __construct(private Payum $payum)
    {
    }

    /**
      * @Route("/payment", name="payment")
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
