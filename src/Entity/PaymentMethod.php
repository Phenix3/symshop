<?php

namespace App\Entity;

use App\Entity\Traits\IdentifiableTrait;
use App\Entity\Traits\ToggleableTrait;
use App\Repository\PaymentMethodRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaymentMethodRepository::class)
 */
class PaymentMethod
{
    use ToggleableTrait;
    use IdentifiableTrait;

    /**
     * @ORM\ManyToOne(targetEntity=GatewayConfig::class, cascade={"persist", "remove"})
     */
    private ?GatewayConfig $gatewayConfig = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name = '';

    /**
     * @ORM\Column(type="text")
     */
    private string $description = '';

    /**
     * @ORM\Column(type="text")
     */
    private string $instructions = '';


    public function getGatewayConfig(): ?GatewayConfig
    {
        return $this->gatewayConfig;
    }

    public function setGatewayConfig(?GatewayConfig $gatewayConfig): self
    {
        $this->gatewayConfig = $gatewayConfig;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(string $instructions): self
    {
        $this->instructions = $instructions;

        return $this;
    }
}
