<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="Infra\Symfony\Persistance\Doctrine\Repository\ClubRepository")
 */
class Club
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vatNumber;

    /**
     * @ORM\OneToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\Address", cascade={"persist", "remove"})
     */
    private $headOfficeAddress;

    /**
     * @ORM\OneToMany(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\ClubYear", mappedBy="club")
     */
    private $clubYears;

    public function __construct()
    {
        $this->clubYears = new ArrayCollection();
    }

    public function __toString()
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

    public function getVatNumber(): ?string
    {
        return $this->vatNumber;
    }

    public function setVatNumber(?string $vatNumber): self
    {
        $this->vatNumber = $vatNumber;

        return $this;
    }

    public function getHeadOfficeAddress(): ?Address
    {
        return $this->headOfficeAddress;
    }

    public function setHeadOfficeAddress(Address $headOfficeAddress): self
    {
        $this->headOfficeAddress = $headOfficeAddress;

        return $this;
    }

    /**
     * @return Collection|ClubYear[]
     */
    public function getClubYears(): Collection
    {
        return $this->clubYears;
    }

    public function addClubYear(ClubYear $clubYear): self
    {
        if (!$this->clubYears->contains($clubYear)) {
            $this->clubYears[] = $clubYear;
            $clubYear->setClub($this);
        }

        return $this;
    }

    public function removeClubYear(ClubYear $clubYear): self
    {
        if ($this->clubYears->contains($clubYear)) {
            $this->clubYears->removeElement($clubYear);
            // set the owning side to null (unless already changed)
            if ($clubYear->getClub() === $this) {
                $clubYear->setClub(null);
            }
        }

        return $this;
    }
}
