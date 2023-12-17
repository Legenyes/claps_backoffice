<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\ClothesCostumePieceRepository;

#[ApiResource]
#[ORM\Entity(repositoryClass: ClothesCostumePieceRepository::class)]
class ClothesCostumePiece implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isDefault = true;

    #[ORM\ManyToOne(targetEntity: ClothesCostume::class,inversedBy: 'clothesCostumePieces', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $costume;

    #[ORM\ManyToOne(targetEntity: ClothesPiece::class, inversedBy: 'clothesCostumePieces', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $piece;

    public function __toString(): string
    {
        return $this->costume . ' - '. $this->piece;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCostume(): ?ClothesCostume
    {
        return $this->costume;
    }

    public function setCostume(?ClothesCostume $costume): self
    {
        $this->costume = $costume;

        return $this;
    }

    public function getPiece(): ?ClothesPiece
    {
        return $this->piece;
    }

    public function setPiece(?ClothesPiece $piece): self
    {
        $this->piece = $piece;

        return $this;
    }

    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    public function setIsDefault(bool $isDefault): self
    {
        $this->isDefault = $isDefault;

        return $this;
    }
}
