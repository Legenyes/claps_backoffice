<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ClothesCostumeRepository")
 */
class ClothesCostume
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
     * @ORM\ManyToOne(targetEntity="App\Entity\ClothesSeason")
     */
    private $season;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\ClothesOpportunity")
     */
    private $clotheOpportunity;

    /**
     * @ORM\Column(name="gender", type="array", nullable=true)
     */
    private $gender;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Section")
     */
    private $sections;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\ClothesCostumePiece",
     *     mappedBy="costume",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     */
    private $clothesCostumePieces;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->clothesCostumePieces = new ArrayCollection();
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

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     * @return ClothesCostume
     */
    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getArea(): ?string
    {
        return $this->area;
    }

    /**
     * @param string|null $area
     * @return ClothesCostume
     */
    public function setArea(?string $area): self
    {
        $this->area = $area;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return ClothesCostume
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return ClothesOpportunity|null
     */
    public function getClotheOpportunity(): ?ClothesOpportunity
    {
        return $this->clotheOpportunity;
    }

    /**
     * @param ClothesOpportunity|null $clotheOpportunity
     * @return ClothesCostume
     */
    public function setClotheOpportunity(?ClothesOpportunity $clotheOpportunity): self
    {
        $this->clotheOpportunity = $clotheOpportunity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     * @return ClothesCostume
     */
    public function setGender($gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return array
     */
    public static function getGenders()
    {
        return array(
            'M' => 'homme',
            'F' => 'femme');
    }

    /**
     * @return Collection|Section[]
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    /**
     * @param Section $section
     * @return ClothesCostume
     */
    public function addSection(Section $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections[] = $section;
        }

        return $this;
    }

    /**
     * @param Section $section
     * @return ClothesCostume
     */
    public function removeSection(Section $section): self
    {
        if ($this->sections->contains($section)) {
            $this->sections->removeElement($section);
        }

        return $this;
    }

    /**
     * @return Collection|ClothesCostumePiece[]
     */
    public function getClothesCostumePieces(): Collection
    {
        return $this->clothesCostumePieces;
    }

    public function setClothesCostumePieces($collection)
    {
        if (gettype($collection) == "array") {
            $collection = new ArrayCollection($collection);
        }

        foreach($collection as $item) {
            $item->setCostume($this);
        }

        $this->clothesCostumePieces = $collection;

        return $this;
    }

    public function addClothesCostumePiece(ClothesCostumePiece $clothesCostumePiece): self
    {
        if (!$this->clothesCostumePieces->contains($clothesCostumePiece)) {
            $this->clothesCostumePieces[] = $clothesCostumePiece;
            $clothesCostumePiece->setCostume($this);
        }

        return $this;
    }

    public function removeClothesCostumePiece(ClothesCostumePiece $clothesCostumePiece): self
    {
        if ($this->clothesCostumePieces->contains($clothesCostumePiece)) {
            $this->clothesCostumePieces->removeElement($clothesCostumePiece);
            // set the owning side to null (unless already changed)
            if ($clothesCostumePiece->getCostume() === $this) {
                $clothesCostumePiece->setCostume(null);
            }
        }

        return $this;
    }
}
