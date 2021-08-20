<?php


namespace App\Entity;

use App\Entity\Traits\IdentifiableTrait;
use Doctrine\ORM\Mapping as ORM;
use Payum\Core\Model\GatewayConfig as BaseGatewayConfig;


/**
 * Class GatewayConfig
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table()
 */
class GatewayConfig extends BaseGatewayConfig
{

    use IdentifiableTrait;

}