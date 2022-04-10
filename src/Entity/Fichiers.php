<?php

namespace App\Entity;

use App\Repository\FichiersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FichiersRepository::class)]
/**
 * @Vich\Uploadable
 */
class Fichiers
{
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $title;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $UpdatedAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private $CreatedAt;

    /**
     * @Vich\UploadableField(mapping="fichier", fileNameProperty="fileName")
     * @var File|null
     */
    #[Assert\File(maxSize: "3M", mimeTypes: [
        "application/pdf",
        "image/png"
    ], maxSizeMessage: "Le fichier est trop volumineux (3Mo MAX)")]
    private $file;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $fileName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function setFile(?File $file = null): void
    {
        $this->file = $file;
        if (null !== $file) {
            $this->updatedAt = new \DateTime();
        }
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFilename(?string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getFilename(): ?string
    {
        return $this->fileName;
    }
}
