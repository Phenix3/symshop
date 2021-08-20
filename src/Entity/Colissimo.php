<?php

namespace App\Entity;

use App\Repository\ColissimoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColissimoRepository::class)
 */
class Colissimo
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="colissimos", fetch="EAGER")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity=RangeValue::class, inversedBy="colissimos", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rangeValue;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

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
