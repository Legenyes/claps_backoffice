<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\ClothesPieceStockRepository;

#[ApiResource]
#[ORM\Entity(repositoryClass: ClothesPieceStockRepository::class)]
class ClothesPieceStock implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $personal = false;

    #[ORM\Column(type: Types::STRING, length: 32)]
    private string $status;

    #[ORM\ManyToOne(targetEntity: ClothesPiece::class, inversedBy: 'clothesPieceStocks')]
    #[ORM\JoinColumn(nullable: false)]
    private $clothesPiece;

    #[ORM\ManyToOne(targetEntity: Member::class, inversedBy: 'clothesPieceStitched')]
    private $dressMaker;

    #[ORM\ManyToMany(targetEntity: ClothesColor::class, inversedBy: 'clothesPieceStocks')]
    private $colors;

    #[ORM\ManyToOne(targetEntity: Member::class, inversedBy: 'clothesPieces')]
    private $dressKeeper;

    public function __construct()
    {
        $this->colors = new ArrayCollection();
    }

    public function __toString(): string
    {
        $result = $this->getClothesPiece()->getName();

        if($this->getDressKeeper()){
            $result .= " (".  $this->getDressKeeper()->__toString() .")";
        }

        return (string) $result;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonal(): ?bool
    {
        return $this->personal;
    }

    public function setPersonal(bool $personal): self
    {
        $this->personal = $personal;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getClothesPiece(): ?ClothesPiece
    {
        return $this->clothesPiece;
    }

    public function setClothesPiece(?ClothesPiece $clothesPiece): self
    {
        $this->clothesPiece = $clothesPiece;

        return $this;
    }

    public function getDressMaker(): ?Member
    {
        return $this->dressMaker;
    }

    public function setDressMaker(?Member $dressMaker): self
    {
        $this->dressMaker = $dressMaker;

        return $this;
    }

    public function getDressKeeper(): ?Member
    {
        return $this->dressKeeper;
    }

    public function setDressKeeper(?Member $dressKeeper): self
    {
        $this->dressKeeper = $dressKeeper;

        return $this;
    }

    /**
     * @return Collection|ClothesColor[]
     */
    public function getColors()
    {
        return $this->colors;
    }

    public function addColor(ClothesColor $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors[] = $color;
        }

        return $this;
    }

    public function removeColor(ClothesColor $color): self
    {
        if ($this->colors->contains($color)) {
            $this->colors->removeElement($color);
        }

        return $this;
    }
}
