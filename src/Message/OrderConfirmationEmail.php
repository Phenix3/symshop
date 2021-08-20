<?php

namespace App\Message;

use App\Entity\Order;

final class OrderConfirmationEmail
{
    /*
     * Add whatever properties & methods you need to hold the
     * data for this message class.
     */

     private $order;


     public function __construct(Order $order)
     {
         $this->order = $order;
     }

     /**
      * Get the value of order
      */ 
     public function getOrder(): Order
     {
          return $this->order;
     }
}
