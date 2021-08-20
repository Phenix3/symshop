<?php

namespace App\Message;

use App\Entity\Product;
use App\Entity\Review;

final class NewProductReviewMessage
{
    /**
     * @var Review
     */
    private Review $review;
    /**
     * @var Product
     */
    private Product $product;

    public function __construct(Review $review, Product $product)
    {
        $this->review = $review;
        $this->product = $product;
    }

    /**
     * @return Review
     */
    public function getReview(): Review
    {
        return $this->review;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }
}
