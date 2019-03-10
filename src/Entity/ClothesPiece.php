<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ClothesPieceRepository")
 */
class ClothesPiece
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
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClothesSeason", inversedBy="clothesPieces")
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClothesType", inversedBy="clothesPieces")
     */
    private $clotheType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $area;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClothesTexture", inversedBy="clothesPieces")
     */
    private $clotheTexture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClothesOpportunity", inversedBy="clothesPieces")
     */
    private $clotheOpportunity;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $personal;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Section", inversedBy="clothesPieces")
     */
    private $sections;


    public function __construct()
    {
        $this->sections = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name . '('. $this->code .')';
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

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSeason(): ?clothesSeason
    {
        return $this->season;
    }

    public function setSeason(?clothesSeason $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getClotheType(): ?ClothesType
    {
        return $this->clotheType;
    }

    public function setClotheType(?ClothesType $clotheType): self
    {
        $this->clotheType = $clotheType;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(?string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getClotheTexture(): ?ClothesTexture
    {
        return $this->clotheTexture;
    }

    public function setClotheTexture(?ClothesTexture $clotheTexture): self
    {
        $this->clotheTexture = $clotheTexture;

        return $this;
    }

    public function getClotheOpportunity(): ?ClothesOpportunity
    {
        return $this->clotheOpportunity;
    }

    public function setClotheOpportunity(?ClothesOpportunity $clotheOpportunity): self
    {
        $this->clotheOpportunity = $clotheOpportunity;

        return $this;
    }

    public function getPersonal(): ?bool
    {
        return $this->personal;
    }

    public function setPersonal(?bool $personal): self
    {
        $this->personal = $personal;

        return $this;
    }

    /**
     * @return Collection|Section[]
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections[] = $section;
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->sections->contains($section)) {
            $this->sections->removeElement($section);
        }

        return $this;
    }
}
