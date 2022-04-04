<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\ClothesColorRepository;

#[ApiResource]
#[ORM\Entity(repositoryClass: ClothesColorRepository::class)]
class ClothesColor implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::STRING)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 10, nullable: true)]
    private ?string $code = null;

    #[ORM\ManyToMany(targetEntity: ClothesPieceStock::class, mappedBy: 'colors')]
    private $clothesPieceStocks;

    public function __construct()
    {
        $this->clothesPieceStocks = new ArrayCollection();
    }

    public function __toString(): string
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

    public function getCode(): ?string
    {
        return $this->code;
    }

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
