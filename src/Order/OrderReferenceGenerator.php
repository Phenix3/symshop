<?php


namespace App\Order;

class OrderReferenceGenerator
{
    private $startNumber;
    private $numberLength;

    public function __construct($startNumber = 1, $numberLength = 9)
    {
        $this->startNumber = $startNumber;
        $this->numberLength = $numberLength;
    }

    public function generateReference($index = 1): string
    {
        $number = $this->startNumber + $index;
        return \str_pad((string) $number, $this->numberLength, '0', \STR_PAD_LEFT);
    }
}