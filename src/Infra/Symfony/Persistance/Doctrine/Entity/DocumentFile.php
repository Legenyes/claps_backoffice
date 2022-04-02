<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="Infra\Symfony\Persistance\Doctrine\Repository\DocumentFileRepository")
 * @Vich\Uploadable
 */
class DocumentFile implements \Stringable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
				 * @ORM\Column(type="string", length=255, nullable=true)
				 */
				private string $document;

    /**
				 * @Vich\UploadableField(mapping="documents", fileNameProperty="document")
				 */
				private ?\Symfony\Component\HttpFoundation\File\File $documentFile = null;

    /**
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\DocumentCategory", inversedBy="documentFiles")
     */
    private $documentCategory;

    /**
				 * @ORM\Column(type="datetime", nullable=true))
				 */
				private \DateTime $updatedAt;

    public function __toString(): string
    {
	return (string) $this->name;
    }

    public function getId(): ?int
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

    public function getDocumentCategory(): ?DocumentCategory
    {
        return $this->documentCategory;
    }

    public function setDocumentCategory(?DocumentCategory $documentCategory): self
    {
        $this->documentCategory = $documentCategory;

        return $this;
    }

    public function setDocumentFile(File $documentFile = null)
    {
        $this->documentFile = $documentFile;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($documentFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getDocumentFile()
    {
        return $this->documentFile;
    }

    public function setDocument($document)
    {
        $this->document = $document;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): DocumentFile
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
