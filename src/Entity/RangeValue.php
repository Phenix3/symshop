<?php

namespace App\Entity;

use Stringable;
use App\Repository\RangeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RangeRepository::class)
 */
class RangeValue implements Stringable
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
    private $max;

    /**
     * @ORM\OneToMany(targetEntity=Colissimo::class, mappedBy="rangeValue", orphanRemoval=true)
     */
    private $colissimos;

    /**
     * @ORM\OneToMany(targetEntity=Country::class, mappedBy="rangeValue")
     */
    private $countries;

    public function __construct()
    {
        $this->colissimos = new ArrayCollection();
        $this->countries = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMax(): ?string
    {
        return $this->max;
    }

    public function setMax(string $max): self
    {
        $this->max = $max;

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
            $colissimo->setRange($this);
        }

        return $this;
    }

    public function removeColissimo(Colissimo $colissimo): self
    {
        if ($this->colissimos->contains($colissimo)) {
            $this->colissimos->removeElement($colissimo);
            // set the owning side to null (unless already changed)
            if ($colissimo->getRange() === $this) {
                $colissimo->setRange(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Country[]
     */
    public function getCountries(): Collection
    {
        return $this->countries;
    }

    public function addCountry(Country $country): self
    {
        if (!$this->countries->contains($country)) {
            $this->countries[] = $country;
            $country->setRange($this);
        }

        return $this;
    }

    public function removeCountry(Country $country): self
    {
        if ($this->countries->contains($country)) {
            $this->countries->removeElement($country);
            // set the owning side to null (unless already changed)
            if ($country->getRange() === $this) {
                $country->setRange(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) "< {$this->max}";
    }
}
