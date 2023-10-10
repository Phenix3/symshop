<?php

namespace App\Entity;

use App\Entity\Traits\Timestamp;
use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @var ArrayCollection|mixed|Order[]
     */
    public $orders;
    use Timestamp;

    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isProfessionnal;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotNull
     * 
     */
    private $civility;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(groups={"app"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(groups={"app"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(groups={"app"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $addressbis;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $bp;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(groups={"app"})
     */
    private $postal;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(groups={"app"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(groups={"app"})
     */
    private $phone;

    /**
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="addresses", fetch="EAGER")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="addresses")
     */
    private $user;


    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getIsProfessionnal(): ?bool
    {
        return $this->isProfessionnal;
    }

    public function setIsProfessionnal(bool $isProfessionnal): self
    {
        $this->isProfessionnal = $isProfessionnal;

        return $this;
    }

    public function getCivility(): ?string
    {
        return $this->civility;
    }

    public function setCivility(string $civility): self
    {
        $this->civility = $civility;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

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

    public function getAddressbis(): ?string
    {
        return $this->addressbis;
    }

    public function setAddressbis(?string $addressbis): self
    {
        $this->addressbis = $addressbis;

        return $this;
    }

    public function getBp(): ?string
    {
        return $this->bp;
    }

    public function setBp(?string $bp): self
    {
        $this->bp = $bp;

        return $this;
    }

    public function getPostal(): ?string
    {
        return $this->postal;
    }

    public function setPostal(string $postal): self
    {
        $this->postal = $postal;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

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

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setBillingAddress($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        // set the owning side to null (unless already changed)
        if ($this->orders->removeElement($order) && $order->getBillingAddress() === $this) {
            $order->setBillingAddress(null);
        }

        return $this;
    }
}
