<?php

namespace App\Message;

use App\Entity\Product;
use App\Entity\Review;

final class NewProductReviewMessage
{
    public function __construct(private Review $review, private Product $product)
    {
    }

    public function getReview(): Review
    {
        return $this->review;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
