<?php

namespace App\Entity;

use Stringable;
use App\Entity\Traits\Timestamp;
use App\Repository\ShopRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 */
class Shop implements Stringable
{
    use Timestamp;

    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $holder;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bic;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iban;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bank;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bankAddress;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $home;

    /**
     * @ORM\Column(type="text")
     */
    private $homeInfos;

    /**
     * @ORM\Column(type="text")
     */
    private $homeShipping;

    /**
     * @ORM\Column(type="boolean", options={"default": true})
     */
    private $hasInvoice;

    /**
     * @ORM\Column(type="boolean", options={"default": true})
     */
    private $hasCard;

    /**
     * @ORM\Column(type="boolean", options={"default": true})
     */
    private $hasTransfer;

    /**
     * @ORM\Column(type="boolean", options={"default": true})
     */
    private $hasCheck;

    /**
     * @ORM\Column(type="boolean", options={"default": true})
     */
    private $hasMandat;

    public function __toString(): string
    {
        return (string) $this->name;
    }

    public function getId(): ?string
    {
        return $this->id;
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getHolder(): ?string
    {
        return $this->holder;
    }

    public function setHolder(string $holder): self
    {
        $this->holder = $holder;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBic(): ?string
    {
        return $this->bic;
    }

    public function setBic(string $bic): self
    {
        $this->bic = $bic;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getBank(): ?string
    {
        return $this->bank;
    }

    public function setBank(string $bank): self
    {
        $this->bank = $bank;

        return $this;
    }

    public function getBankAddress(): ?string
    {
        return $this->bankAddress;
    }

    public function setBankAddress(string $bankAddress): self
    {
        $this->bankAddress = $bankAddress;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getHome(): ?string
    {
        return $this->home;
    }

    public function setHome(string $home): self
    {
        $this->home = $home;

        return $this;
    }

    public function getHomeInfos(): ?string
    {
        return $this->homeInfos;
    }

    public function setHomeInfos(string $homeInfos): self
    {
        $this->homeInfos = $homeInfos;

        return $this;
    }

    public function getHomeShipping(): ?string
    {
        return $this->homeShipping;
    }

    public function setHomeShipping(string $homeShipping): self
    {
        $this->homeShipping = $homeShipping;

        return $this;
    }

    public function getHasInvoice(): ?bool
    {
        return $this->hasInvoice;
    }

    public function setHasInvoice(bool $hasInvoice): self
    {
        $this->hasInvoice = $hasInvoice;

        return $this;
    }

    public function getHasCard(): ?bool
    {
        return $this->hasCard;
    }

    public function setHasCard(bool $hasCard): self
    {
        $this->hasCard = $hasCard;

        return $this;
    }

    public function getHasTransfer(): ?bool
    {
        return $this->hasTransfer;
    }

    public function setHasTransfer(bool $hasTransfer): self
    {
        $this->hasTransfer = $hasTransfer;

        return $this;
    }

    public function getHasCheck(): ?bool
    {
        return $this->hasCheck;
    }

    public function setHasCheck(bool $hasCheck): self
    {
        $this->hasCheck = $hasCheck;

        return $this;
    }

    public function getHasMandat(): ?bool
    {
        return $this->hasMandat;
    }

    public function setHasMandat(bool $hasMandat): self
    {
        $this->hasMandat = $hasMandat;

        return $this;
    }

}
