<?php

namespace App\Entity;

use App\Entity\Traits\ToggleableTrait;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Doctrine\UuidGenerator;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @Gedmo\Tree(type="nested")
 */
class Category
{
    use ToggleableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private string $name = '';

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private ?string $slug = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description = '';

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="categories")
     */
    private $products;
    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->children = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }


    public function getRoot()
    {
        return $this->root;
    }

    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return mixed
     */
    public function getLeft()
    {
        return $this->lft;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->lvl;
    }

    /**
     * @return mixed
     */
    public function getRight()
    {
        return $this->rgt;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }


    public function hasChild(Category $category): bool
    {
        return $this->children->contains($category);
    }

    public function hasChildren(): bool
    {
        return !$this->children->isEmpty();
    }

    public function addChild(Category $category): void
    {
        if (!$this->hasChild($category)) {
            $this->children->add($category);
        }

        if ($this !== $category->getParent()) {
            $category->setParent($this);
        }
    }

    public function removeChild(Category $category): void
    {
        if ($this->hasChild($category)) {
            $category->setParent(null);

            $this->children->removeElement($category);
        }
    }

    public function getEnabledChildren(): Collection
    {
        return $this->children->filter(
            function (Category $childCategory) {
                return $childCategory->isEnabled();
            }
        );
    }

    public function isRoot(): bool
    {
        return null === $this->parent;
    }


    public function getFullname(string $pathDelimiter = ' / '): ?string
    {
        if ($this->isRoot()) {
            return $this->getName();
        }

        return sprintf(
            '%s%s%s',
            $this->getParent()->getFullname(),
            $pathDelimiter,
            $this->getName()
        );
    }
}
