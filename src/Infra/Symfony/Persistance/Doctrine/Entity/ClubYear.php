<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\ClubYearRepository;

#[ApiResource]
#[ORM\Entity(repositoryClass: ClubYearRepository::class)]
class ClubYear implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isActive = false;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private $dateStart;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private $dateStop;

    #[ORM\ManyToOne(targetEntity: Club::class, inversedBy: 'clubYears')]
    private $club;

    #[ORM\OneToMany(targetEntity: MemberShip::class, mappedBy: 'clubYear', orphanRemoval: true)]
    private $memberShips;

    public function __construct()
    {
        $this->memberShips = new ArrayCollection();
    }

    public function __toString(): string
    {
        $result = "";

        if($this->getClub()) {
            $result .= $this->getClub()->getName();

            $result .= ' '. $this->getDateStart()->format('Y');
            $result .= ' - '. $this->getDateStop()->format('Y');
        }

        return $result;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateStop(): ?\DateTimeInterface
    {
        return $this->dateStop;
    }

    public function setDateStop(\DateTimeInterface $dateStop): self
    {
        $this->dateStop = $dateStop;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

    /**
     * @return Collection|MemberShip[]
     */
    public function getMemberShips(): Collection
    {
        return $this->memberShips;
    }

    public function addMemberShip(MemberShip $memberShip): self
    {
        if (!$this->memberShips->contains($memberShip)) {
            $this->memberShips[] = $memberShip;
            $memberShip->setClubYear($this);
        }

        return $this;
    }

    public function removeMemberShip(MemberShip $memberShip): self
    {
        if ($this->memberShips->contains($memberShip)) {
            $this->memberShips->removeElement($memberShip);
            // set the owning side to null (unless already changed)
            if ($memberShip->getClubYear() === $this) {
                $memberShip->setClubYear(null);
            }
        }

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
