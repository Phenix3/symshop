<?php


namespace App\Order;

class OrderReferenceGenerator
{
    public function __construct(private $startNumber = 1, private $numberLength = 9)
    {
    }

    public function generateReference($index = 1): string
    {
        $number = $this->startNumber + $index;
        return \str_pad((string) $number, $this->numberLength, '0', \STR_PAD_LEFT);
    }
}