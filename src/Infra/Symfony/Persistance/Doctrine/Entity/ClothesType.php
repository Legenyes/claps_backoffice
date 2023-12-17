<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\ClothesTypeRepository;

#[ApiResource]
#[ORM\Entity(repositoryClass: ClothesTypeRepository::class)]
class ClothesType implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: ClothesTypeType::class, inversedBy: 'clothesTypes')]
    private $type;

    #[ORM\ManyToOne(targetEntity: ClothesTypeZone::class, inversedBy: 'clothesTypes')]
    private $zone;

    #[ORM\OneToMany(targetEntity: ClothesPiece::class, mappedBy: 'clotheType')]
    private $clothesPieces;

    public function __construct()
    {
        $this->clothesPieces = new ArrayCollection();
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
