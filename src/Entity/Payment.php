<?php

namespace App\Entity;

use App\Entity\Order;
use App\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;
use Payum\Core\Model\Payment as BasePayment;

/**
 * @ORM\Entity(repositoryClass=PaymentRepository::class)
 */
class Payment extends BasePayment
{
    public const STATE_AUTHORIZED = 'authorized';

    public const STATE_CART = 'cart';

    public const STATE_NEW = 'new';

    public const STATE_PROCESSING = 'processing';

    public const STATE_COMPLETED = 'completed';

    public const STATE_FAILED = 'failed';

    public const STATE_CANCELLED = 'cancelled';

    public const STATE_REFUNDED = 'refunded';

    public const STATE_UNKNOWN = 'unknown';

    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    /**
     * 
     */
    protected ?string $state = self::STATE_NEW;

    /**
     * @ORM\ManyToOne(targetEntity=PaymentMethod::class)
     */
    private $method;

    /**
     * @ORM\OneToOne(targetEntity=Order::class, inversedBy="payment")
     */
    private $order;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getMethod(): ?PaymentMethod
    {
        return $this->method;
    }

    public function setMethod(?PaymentMethod $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }
}
