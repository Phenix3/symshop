<?php

namespace App\Message;

use App\Entity\Product;

final class ProductQuantityAlertEmail
{
    public function __construct(private Product $product)
    {
    }


    /**
     * Get the value of product
     */ 
    public function getProduct(): Product
    {
        return $this->product;
    }

}
