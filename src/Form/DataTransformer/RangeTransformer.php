<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class RangeTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        dump($value);
        return $value;
    }
    
    public function reverseTransform($value)
    {
        dump($value);
        return $value;
    }
}