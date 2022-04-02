<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="Infra\Symfony\Persistance\Doctrine\Repository\ClothesPieceRepository")
 * @Vich\Uploadable
 */
class ClothesPiece implements \Stringable
{
    public const GENDER_MALE = "M";
    public const GENDER_FEMALE = "M";

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
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\ClothesSeason", inversedBy="clothesPieces")
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\ClothesType", inversedBy="clothesPieces")
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
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\ClothesTexture", inversedBy="clothesPieces")
     */
    private $clotheTexture;

    /**
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\ClothesOpportunity", inversedBy="clothesPieces")
     */
    private $clotheOpportunity;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $personal;

    /**
     * @ORM\Column(name="gender", type="array", nullable=true)
     */
    private $gender;

    /**
     * @ORM\ManyToMany(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\Section")
     */
    private $sections;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $image;

    /**
     * @Vich\UploadableField(mapping="clothespiece_images", fileNameProperty="image")
     */
    private ?\Symfony\Component\HttpFoundation\File\File $imageFile = null;

    /**
     * @ORM\Column(type="datetime", nullable=true))
     */
    private \DateTime $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\ClothesCostumePiece", mappedBy="piece", orphanRemoval=true)
     */
    private $clothesCostumePieces;

    /**
     * @ORM\OneToMany(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\ClothesPieceStock", mappedBy="clothesPiece", orphanRemoval=true)
     */
    private $clothesPieceStocks;


    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->clothesCostumePieces = new ArrayCollection();
        $this->clothesPieceStocks = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name . ' ('. $this->code .')';
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
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
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

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): ClothesPiece
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return Collection|ClothesCostumePiece[]
     */
    public function getClothesCostumePieces(): Collection
    {
        return $this->clothesCostumePieces;
    }

    public function addClothesCostumePiece(ClothesCostumePiece $clothesCostumePiece): self
    {
        if (!$this->clothesCostumePieces->contains($clothesCostumePiece)) {
            $this->clothesCostumePieces[] = $clothesCostumePiece;
            $clothesCostumePiece->setPiece($this);
        }

        return $this;
    }

    public function removeClothesCostumePiece(ClothesCostumePiece $clothesCostumePiece): self
    {
        if ($this->clothesCostumePieces->contains($clothesCostumePiece)) {
            $this->clothesCostumePieces->removeElement($clothesCostumePiece);
            // set the owning side to null (unless already changed)
            if ($clothesCostumePiece->getPiece() === $this) {
                $clothesCostumePiece->setPiece(null);
            }
        }

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
            $clothesPieceStock->setClothesPiece($this);
        }

        return $this;
    }

    public function removeClothesPieceStock(ClothesPieceStock $clothesPieceStock): self
    {
        if ($this->clothesPieceStocks->contains($clothesPieceStock)) {
            $this->clothesPieceStocks->removeElement($clothesPieceStock);
            // set the owning side to null (unless already changed)
            if ($clothesPieceStock->getClothesPiece() === $this) {
                $clothesPieceStock->setClothesPiece(null);
            }
        }

        return $this;
    }

}
