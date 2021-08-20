<?php


namespace App\Core\Rating;



use App\Entity\Product;
use App\Entity\Review;

class AverageRatingCalculator
{

    public function calculate(Product $product): float
    {
        $sum = 0;
        $reviewsNumber = 0;
        $reviews = $product->getReviews();

        foreach ($reviews as $review) {
            if (Review::REVIEW_STATUS_ACCEPTED === $review->getStatus()) {
                ++$reviewsNumber;
                $sum += $review->getRating();
            }
        }

        return 0 !== $reviewsNumber ? $sum / $reviewsNumber : 0;
    }

}