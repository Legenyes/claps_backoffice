<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="Infra\Symfony\Persistance\Doctrine\Repository\ClothesPieceStockRepository")
 */
class ClothesPieceStock
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $personal;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\ClothesPiece", inversedBy="clothesPieceStocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clothesPiece;

    /**
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\Member", inversedBy="clothesPieceStitched")
     */
    private $dressMaker;

    /**
     * @ORM\ManyToMany(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\ClothesColor", inversedBy="clothesPieceStocks")
     */
    private $colors;

    /**
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\Member", inversedBy="clothesPieces")
     */
    private $dressKeeper;

    public function __construct()
    {
        $this->colors = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function __toString()
    {
        $result = $this->getClothesPiece()->getName();

        if($this->getDressKeeper()){
            $result .= " (".  $this->getDressKeeper()->__toString() .")";
        }

        return $result;
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
    public function getColors(): Collection
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
