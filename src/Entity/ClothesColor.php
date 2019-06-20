<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ClothesColorRepository")
 */
class ClothesColor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $name
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string $code
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $code;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ClothesPieceStock", mappedBy="colors")
     */
    private $clothesPieceStocks;

    public function __construct()
    {
        $this->clothesPieceStocks = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ClothesColor
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return ClothesColor
     */
    public function setCode(?string $code): ClothesColor
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return Collection|ClothesPieceStock[]
     */
    public function getClothesPieceStocks(): Collection
    {
        return $this->clothesPieceStocks;
    }

    public function addClothesPieceStock(ClothesPieceStock $clothesPieceStock): self
    {
        if (!$this->clothesPieceStocks->contains($clothesPieceStock)) {
            $this->clothesPieceStocks[] = $clothesPieceStock;
            $clothesPieceStock->addColor($this);
        }

        return $this;
    }

    public function removeClothesPieceStock(ClothesPieceStock $clothesPieceStock): self
    {
        if ($this->clothesPieceStocks->contains($clothesPieceStock)) {
            $this->clothesPieceStocks->removeElement($clothesPieceStock);
            $clothesPieceStock->removeColor($this);
        }

        return $this;
    }


}
