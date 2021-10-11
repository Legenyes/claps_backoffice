<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="Infra\Symfony\Persistance\Doctrine\Repository\ClothesTypeRepository")
 */
class ClothesType
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
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\ClothesTypeType", inversedBy="clothesTypes")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\ClothesTypeZone", inversedBy="clothesTypes")
     */
    private $zone;

    /**
     * @ORM\OneToMany(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\ClothesPiece", mappedBy="clotheType")
     */
    private $clothesPieces;

    public function __construct()
    {
        $this->clothesPieces = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getType(): ?ClothesTypeType
    {
        return $this->type;
    }

    public function setType(?ClothesTypeType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getZone(): ?ClothesTypeZone
    {
        return $this->zone;
    }

    public function setZone(?ClothesTypeZone $zone): self
    {
        $this->zone = $zone;

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
            $clothesPiece->setClotheType($this);
        }

        return $this;
    }

    public function removeClothesPiece(ClothesPiece $clothesPiece): self
    {
        if ($this->clothesPieces->contains($clothesPiece)) {
            $this->clothesPieces->removeElement($clothesPiece);
            // set the owning side to null (unless already changed)
            if ($clothesPiece->getClotheType() === $this) {
                $clothesPiece->setClotheType(null);
            }
        }

        return $this;
    }
}
