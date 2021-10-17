<?php

namespace App\Entity;

use App\Entity\Traits\Timestamp;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 *
 *
 * @UniqueEntity(fields={"reference"})
 */
class Order
{
    use Timestamp;

    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     *
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $reference;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $shipping;

    /**
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tax;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $purchaseOrder;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default": false})
     */
    private $pick;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=State::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $state;


    /**
     * @ORM\OneToMany(targetEntity=OrderProduct::class, mappedBy="order", cascade={"persist", "remove"})
     */
    private $orderProducts;

    /**
     * @ORM\OneToOne(targetEntity=Payment::class, mappedBy="order")
     */
    private $payment;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $billingAddress;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $shippingAddress;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notes;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $checkoutCompletedAt;

    /**
     * @ORM\Column(type="string", length=255, options={"default": "cart"})
     */
    private $checkoutState;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tokenValue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paymentState;

    public function __construct()
    {
        $this->orderProducts = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getShipping(): ?string
    {
        return $this->shipping;
    }

    public function setShipping(string $shipping): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getTax(): ?string
    {
        return $this->tax;
    }

    public function setTax(string $tax): self
    {
        $this->tax = $tax;

        return $this;
    }


    public function getPurchaseOrder(): ?string
    {
        return $this->purchaseOrder;
    }

    public function setPurchaseOrder(?string $purchaseOrder): self
    {
        $this->purchaseOrder = $purchaseOrder;

        return $this;
    }

    public function getPick(): ?bool
    {
        return $this->pick;
    }

    public function setPick(?bool $pick): self
    {
        $this->pick = $pick;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

        return $this;
    }


    /**
     * @return Collection|OrderProduct[]
     */
    public function getOrderProducts(): Collection
    {
        return $this->orderProducts;
    }

    public function addOrderProduct(OrderProduct $orderProduct): self
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            $this->orderProducts[] = $orderProduct;
            $orderProduct->setOrder($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): self
    {
        if ($this->orderProducts->contains($orderProduct)) {
            $this->orderProducts->removeElement($orderProduct);
            // set the owning side to null (unless already changed)
            if ($orderProduct->getOrder() === $this) {
                $orderProduct->setOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Payment
     */
    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    /**
     * @param Payment|null $payment
     * @return $this
     */
    public function setPayment(?Payment $payment): self {
        $this->payment = $payment;
        return $this;
    }

    public function getBillingAddress(): ?Address
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(?Address $billingAddress): self
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    public function getShippingAddress(): ?Address
    {
        return $this->shippingAddress;
    }

    public function setShippingAddress(?Address $shippingAddress): self
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getCheckoutCompletedAt(): ?\DateTimeInterface
    {
        return $this->checkoutCompletedAt;
    }

    public function setCheckoutCompletedAt(?\DateTimeInterface $checkoutCompletedAt): self
    {
        $this->checkoutCompletedAt = $checkoutCompletedAt;

        return $this;
    }

    public function getCheckoutState(): ?string
    {
        return $this->checkoutState;
    }

    public function setCheckoutState(string $checkoutState): self
    {
        $this->checkoutState = $checkoutState;

        return $this;
    }

    public function getTokenValue(): ?string
    {
        return $this->tokenValue;
    }

    public function setTokenValue(?string $tokenValue): self
    {
        $this->tokenValue = $tokenValue;

        return $this;
    }

    public function getPaymentState(): ?string
    {
        return $this->paymentState;
    }

    public function setPaymentState(string $paymentState): self
    {
        $this->paymentState = $paymentState;

        return $this;
    }
}
