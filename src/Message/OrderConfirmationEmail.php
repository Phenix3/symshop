<?php

namespace App\Message;

use App\Entity\Order;

final class OrderConfirmationEmail
{
    public function __construct(private Order $order)
     {
     }

     /**
      * Get the value of order
      */ 
     public function getOrder(): Order
     {
          return $this->order;
     }
}
