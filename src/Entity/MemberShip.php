<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MemberShipRepository")
 */
class MemberShip
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
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $subscriptionAmount;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $subscriptionPaidAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClubYear", inversedBy="memberShips")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clubYear;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="memberShips")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Section", inversedBy="memberShips")
     */
    private $sections;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->member .' ('. $this->startDate->format('Y') .'-'.$this->endDate->format('Y') .')';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getSubscriptionAmount()
    {
        return $this->subscriptionAmount;
    }

    public function setSubscriptionAmount($subscriptionAmount): self
    {
        $this->subscriptionAmount = $subscriptionAmount;

        return $this;
    }

    public function getSubscriptionPaidAt(): ?\DateTimeInterface
    {
        return $this->subscriptionPaidAt;
    }

    public function setSubscriptionPaidAt(?\DateTimeInterface $subscriptionPaidAt): self
    {
        $this->subscriptionPaidAt = $subscriptionPaidAt;

        return $this;
    }


    public function getClubYear(): ClubYear
    {
        return $this->clubYear;
    }

    public function setClubYear(ClubYear $clubYear): self
    {
        $this->clubYear = $clubYear;
        $this->startDate = $clubYear->getDateStart();
        $this->endDate = $clubYear->getDateStop();

        return $this;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

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

    public function getExportData()
    {
        return \array_merge([
            'subscription_id' => $this->id,
            'subscriptionAmount' => $this->subscriptionAmount,
            'subscriptionPaidAt' => $this->subscriptionPaidAt ? $this->subscriptionPaidAt->format('d/m/Y H:m') : '',
        ], $this->getMember()->getExportData());
    }

}
