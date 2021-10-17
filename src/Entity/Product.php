<?php

namespace App\Entity;

use App\Entity\Traits\Timestamp;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @UniqueEntity(fields = {"name"})
 */
class Product
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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank
     */
    private string $name = '';

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank
     */
    private string $slug = '';

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    private float $price = 0.0;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    private float $weight = 0.0;

    /**
     * @ORM\Column(type="boolean", options={"default": false}, nullable=true)
     */
    private bool $isActive = false;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     * @Assert\NotBlank
     * @Assert\Positive()
     */
    private int $quantity = 0;

    /**
     * @ORM\Column(type="integer", options={"default":10})
     * @Assert\NotBlank
     * @Assert\Positive()
     */
    private int $quantityAlert = 10;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Attachment", cascade={"persist", "remove"})
     */
    private ?Attachment $image = null;


    private array $imagePaths = [];

    /**
     * @ORM\Column(type="text")
     */
    private string $description = '';

    /**
     * @ORM\OneToMany(targetEntity=OrderProduct::class, mappedBy="product")
     */
    private $orderProducts;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $metaKeywords = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $metaDescription = '';

    /**
     * @ORM\ManyToMany(targetEntity=Attachment::class, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="product_attachment",
     *     joinColumns={
     *      @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *          @ORM\JoinColumn(name="attachment_id", referencedColumnName="id", unique=true)
     *      }
     * )
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="product", orphanRemoval=true)
     */
    private $reviews;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, mappedBy="products", cascade={"persist"})
     */
    private $categories;



    public function __construct()
    {
        $this->orderProducts = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function serialize()
    {
        return \json_encode([
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'description' => $this->description,
            'imagePaths' => $this->getImagePaths()
        ], JSON_PRETTY_PRINT);
    }

    public function unserialize($serialized): void
    {
        [$this->name, $this->slug, $this->price, $this->description] = \unserialize($serialized, ['allowed_classes' => false]);
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getReviewsCount(): int
    {
        return count($this->reviews);
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


    /**
     * Get the value of slug
     */ 
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */ 
    public function setSlug($slug): self
    {
        $this->slug = $slug;

        return $this;
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

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getQuantityAlert(): ?int
    {
        return $this->quantityAlert;
    }

    public function setQuantityAlert(int $quantityAlert): self
    {
        $this->quantityAlert = $quantityAlert;

        return $this;
    }

    public function getImage(): ?Attachment
    {
        return $this->image;
    }

    public function setImage(?Attachment $image): self
    {
        $this->image = $image;

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

    /**
     * Get the value of imagePaths
     */ 
    public function getImagePaths()
    {
        return $this->imagePaths;
    }

    /**
     * Set the value of imagePaths
     *
     * @return  self
     */ 
    public function setImagePaths($imagePaths)
    {
        $this->imagePaths = $imagePaths;

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
            $orderProduct->setProduct($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): self
    {
        if ($this->orderProducts->removeElement($orderProduct)) {
            // set the owning side to null (unless already changed)
            if ($orderProduct->getProduct() === $this) {
                $orderProduct->setProduct(null);
            }
        }

        return $this;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords(?string $metaKeywords): self
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): self
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * @return Collection|Attachment[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Attachment $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
        }

        return $this;
    }

    public function removeImage(Attachment $image): self
    {
        $this->images->removeElement($image);

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setProduct($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getProduct() === $this) {
                $review->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addProduct($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeProduct($this);
        }

        return $this;
    }


}
