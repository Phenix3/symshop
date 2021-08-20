<?php

namespace App\Entity;

use App\Entity\Traits\Timestamp;
use App\Repository\AttachmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=AttachmentRepository::class)
 * @Vich\Uploadable()
 */
class Attachment
{
    use Timestamp;

    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private ?string $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $fileName = '';

    /**
     * @Vich\UploadableField(mapping="attachments", fileNameProperty="fileName", size="fileSize")
     * @var File|null
     */
    private ?File $file = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $fileSize = 0;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName ?: '';

        return $this;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    public function setFileSize(?int $fileSize): self
    {
        $this->fileSize = $fileSize ?: 0;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File|null $file
     * @return self
     */
    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }

}
