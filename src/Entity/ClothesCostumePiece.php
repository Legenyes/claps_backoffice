<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ClothesCostumePieceRepository")
 */
class ClothesCostumePiece
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\ClothesCostume",
     *     inversedBy="clothesCostumePieces",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private $costume;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\ClothesPiece",
     *     inversedBy="clothesCostumePieces",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private $piece;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDefault = true;


    public function __toString()
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
