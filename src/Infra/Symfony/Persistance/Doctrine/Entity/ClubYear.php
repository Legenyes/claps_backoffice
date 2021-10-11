<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="Infra\Symfony\Persistance\Doctrine\Repository\ClubYearRepository")
 */
class ClubYear
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="date")
     */
    private $dateStop;

    /**
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\Club", inversedBy="clubYears")
     */
    private $club;

    /**
     * @ORM\OneToMany(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\MemberShip", mappedBy="clubYear", orphanRemoval=true)
     */
    private $memberShips;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isActive;

    public function __construct()
    {
        $this->memberShips = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function __toString()
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
