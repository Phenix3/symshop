<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * 
     * @Assert\PositiveOrZero
     * @Assert\NotNull
     * @Assert\Regex("/^(\d+(?:[\.\,]\d{1,2})?)$/")
     */
    private $tax;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="country")
     */
    private $addresses;


    /**
     * @ORM\OneToMany(targetEntity=Colissimo::class, mappedBy="country")
     */
    private $colissimos;

    /**
     * @ORM\ManyToOne(targetEntity=RangeValue::class, inversedBy="countries")
     */
    private $rangeValue;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->colissimos = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getTax(): ?string
    {
        return $this->tax;
    }

    public function setTax(string $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * @return Collection|Address[]
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setCountry($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
            // set the owning side to null (unless already changed)
            if ($address->getCountry() === $this) {
                $address->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Colissimo[]
     */
    public function getColissimos(): Collection
    {
        return $this->colissimos;
    }

    public function addColissimo(Colissimo $colissimo): self
    {
        if (!$this->colissimos->contains($colissimo)) {
            $this->colissimos[] = $colissimo;
            $colissimo->setCountry($this);
        }

        return $this;
    }

    public function removeColissimo(Colissimo $colissimo): self
    {
        if ($this->colissimos->contains($colissimo)) {
            $this->colissimos->removeElement($colissimo);
            // set the owning side to null (unless already changed)
            if ($colissimo->getCountry() === $this) {
                $colissimo->setCountry(null);
            }
        }

        return $this;
    }

    public function getRangeValue(): ?RangeValue
    {
        return $this->rangeValue;
    }

    public function setRangeValue(?RangeValue $rangeValue): self
    {
        $this->rangeValue = $rangeValue;

        return $this;
    }
}
