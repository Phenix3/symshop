<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Traits\Timestamp;
use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 *
 */
class Review
{
    use Timestamp;

    public const REVIEW_STATUS_PENDING = 'PENDING';
    public const REVIEW_STATUS_ACCEPTED = 'ACCEPTED';
    public const REVIEW_STATUS_REJECTED = 'REJECTED';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $rating = 0;

    /**
     * @ORM\Column(type="text")
     */
    private string $comment = '';

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="reviews")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reviews", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=20, nullable=true, options={"default"=self::REVIEW_STATUS_PENDING})
     */
    private $status;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        if (!in_array($status, [self::REVIEW_STATUS_ACCEPTED, self::REVIEW_STATUS_PENDING, self::REVIEW_STATUS_REJECTED])) {
            throw new \InvalidArgumentException(sprintf("Invalid status value: %s", $status));
        }
        $this->status = $status;

        return $this;
    }
}
