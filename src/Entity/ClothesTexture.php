<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ClothesTextureRepository")
 */
class ClothesTexture
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
     * @ORM\OneToMany(targetEntity="App\Entity\ClothesPiece", mappedBy="clotheTexture")
     */
    private $clothesPieces;

    public function __construct()
    {
        $this->clothesPieces = new ArrayCollection();
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

    /**
     * @return Collection|ClothesPiece[]
     */
    public function getClothesPieces(): Collection
    {
        return $this->clothesPieces;
    }

    public function addClothesPiece(ClothesPiece $clothesPiece): self
    {
        if (!$this->clothesPieces->contains($clothesPiece)) {
            $this->clothesPieces[] = $clothesPiece;
            $clothesPiece->setClotheTexture($this);
        }

        return $this;
    }

    public function removeClothesPiece(ClothesPiece $clothesPiece): self
    {
        if ($this->clothesPieces->contains($clothesPiece)) {
            $this->clothesPieces->removeElement($clothesPiece);
            // set the owning side to null (unless already changed)
            if ($clothesPiece->getClotheTexture() === $this) {
                $clothesPiece->setClotheTexture(null);
            }
        }

        return $this;
    }
}
