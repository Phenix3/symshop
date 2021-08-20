<?php

namespace App\Message;

use App\Entity\Product;

final class ProductQuantityAlertEmail
{
    /*
     * Add whatever properties & methods you need to hold the
     * data for this message class.
     */

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    /**
     * Get the value of product
     */ 
    public function getProduct(): Product
    {
        return $this->product;
    }

}
