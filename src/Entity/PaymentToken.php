<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Payum\Core\Model\Token;


/**
 * @ORM\Entity
 * @ORM\Table
 */
class PaymentToken extends Token
{

}