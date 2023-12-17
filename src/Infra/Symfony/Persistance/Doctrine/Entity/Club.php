<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\ClubRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    #[Assert\Email]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $email = null;

    #[Assert\Url]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $website = null;

    #[Assert\Iban]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $bankNumber = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $vatNumber = null;

    #[ORM\OneToOne(targetEntity: Address::class, cascade: ['persist', 'remove'])]
    private $headOfficeAddress;

    #[ORM\OneToMany(targetEntity: ClubYear::class, mappedBy: 'club')]
    private $clubYears;

    public function __construct()
    {
        $this->clubYears = new ArrayCollection();
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
