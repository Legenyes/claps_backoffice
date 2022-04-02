<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="Infra\Symfony\Persistance\Doctrine\Repository\DocumentCategoryRepository")
 */
class DocumentCategory implements \Stringable
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
     * @ORM\Column(type="string", length=32)
     */
    private $icon;

    /**
     * @ORM\OneToMany(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\DocumentFile", mappedBy="documentCategory")
     */
    private $documentFiles;

    public function __construct()
    {
        $this->documentFiles = new ArrayCollection();
    }

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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return Collection|DocumentFile[]
     */
    public function getDocumentFiles(): Collection
    {
        return $this->documentFiles;
    }

    public function addDocumentFile(DocumentFile $documentFile): self
    {
        if (!$this->documentFiles->contains($documentFile)) {
            $this->documentFiles[] = $documentFile;
            $documentFile->setDocumentCategory($this);
        }

        return $this;
    }

    public function removeDocumentFile(DocumentFile $clubYear): self
    {
        if ($this->documentFiles->contains($clubYear)) {
            $this->documentFiles->removeElement($clubYear);
        }

        return $this;
    }
}
