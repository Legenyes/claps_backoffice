<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\ClothesTypeZoneRepository;

#[ApiResource]
#[ORM\Entity(repositoryClass: ClothesTypeZoneRepository::class)]
class ClothesTypeZone implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    #[ORM\OneToMany(targetEntity: ClothesType::class, mappedBy: 'zone')]
    private $clothesTypes;

    public function __construct()
    {
        $this->clothesTypes = new ArrayCollection();
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

    /**
     * @return Collection|ClothesType[]
     */
    public function getClothesTypes(): Collection
    {
        return $this->clothesTypes;
    }

    public function addClothesType(ClothesType $clothesType): self
    {
        if (!$this->clothesTypes->contains($clothesType)) {
            $this->clothesTypes[] = $clothesType;
            $clothesType->setZone($this);
        }

        return $this;
    }

    public function removeClothesType(ClothesType $clothesType): self
    {
        if ($this->clothesTypes->contains($clothesType)) {
            $this->clothesTypes->removeElement($clothesType);
            // set the owning side to null (unless already changed)
            if ($clothesType->getZone() === $this) {
                $clothesType->setZone(null);
            }
        }

        return $this;
    }
}
