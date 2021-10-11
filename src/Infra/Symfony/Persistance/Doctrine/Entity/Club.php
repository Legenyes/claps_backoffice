<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Email()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @Assert\Url()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @Assert\Iban()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bankNumber;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getBankNumber(): ?string
    {
        return $this->bankNumber;
    }

    public function setBankNumber(?string $bankNumber): self
    {
        $this->bankNumber = $bankNumber;

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
