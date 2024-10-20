<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\MemberShipRepository;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[ApiResource]
#[ORM\Entity(repositoryClass: MemberShipRepository::class)]
class MemberShip implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private $startDate;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private $endDate;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private $subscriptionAmount;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private $subscriptionPaidAt;

    #[ORM\ManyToOne(targetEntity: ClubYear::class, inversedBy: 'memberShips')]
    #[ORM\JoinColumn(nullable: false)]
    private $clubYear;

    #[ORM\ManyToOne(targetEntity: Member::class, inversedBy: 'memberShips')]
    #[ORM\JoinColumn(nullable: false)]
    private $member;

    #[ORM\ManyToMany(targetEntity: Section::class, inversedBy: 'memberShips')]
    private $sections;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
    }

    public function __toString(): string
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

    public function getSubscripptionType(): string
    {
        $age = $this->getMember()->getAge();

        if (!$age) {
            return '';
        } elseif ($age < 7) {
            return '< 7 ANS';
        } elseif ($age < 16) {
            return '< 16 ANS';
        } else {
            return 'ADULTES';
        }
    }

    public function isPaid(): bool
    {
        return $this->subscriptionPaidAt !== null;
    }

    public function getDiscount(): string
    {
        if (!$this->getMember()) {
            return '';
        }

        $families = $this->getMember()->getFamilies();
        foreach ($families as $family) {
            if ($family->getFamillyMembers() && $family->getFamillyMembers()->count() >= 3) {
                return ' -20 %';
            }
        }

        return '';
    }

    public function getExportData()
    {
        $sections = '';
        foreach ($this->sections as $section) {
            $sections .= $section->getName() .' ';
        }

        return \array_merge([
            'sections' => $sections,
            '.TYPE' => $this->getSubscripptionType(),
            '.FEE' => $this->subscriptionAmount,
            '.DISCOUNT' => $this->getDiscount(),
            '.PAID_AT' => $this->subscriptionPaidAt ? $this->subscriptionPaidAt->format('d/m/Y H:m') : '',
        ], $this->getMember()->getExportData());
    }

    public function getPdfFileName(string $type): string
    {
        $member = $this->getMember();
        $clubYear = $this->getClubYear();

        $slugger = new AsciiSlugger();
        $filename = $slugger->slug($member->getLastname() . ' ' . $member->getFirstname());
        $filename .= " - ". $slugger->slug($type);
        $filename .= " - ". $slugger->slug($clubYear->__toString());

        return sprintf("%s.pdf", $filename);
    }
}
