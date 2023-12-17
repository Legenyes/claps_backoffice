<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\MemberRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity(repositoryClass: MemberRepository::class)]
class Member implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[Assert\Length(min: 2, max: 255)]
     #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
     private ?string $firstname = null;

    #[Assert\Length(min: 2, max: 255)]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $lastname = null;

    #[Assert\Email]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $mobilePhone = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private $birthdate;

    #[ORM\Column(type: Types::STRING, length: 5, nullable: true)]
    private ?string $sex = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $niss = null;

     #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $insurer = null;

    #[ORM\OneToOne(targetEntity: Address::class, cascade: ['persist', 'remove'])]
    private $address;

    #[Assert\Valid]
    #[ORM\OneToOne(targetEntity: BodyMeasurement::class, cascade: ['persist', 'remove'])]
    private $bodyMeasurement;

    #[ORM\ManyToMany(targetEntity: MemberFamily::class, inversedBy: 'famillyMembers')]
    private $families;

    #[ORM\OneToMany(targetEntity: MemberShip::class, mappedBy: 'member', orphanRemoval: true)]
    private $memberShips;

    #[ORM\OneToMany(targetEntity: ClothesPieceStock::class, mappedBy: 'dressMaker')]
    private $clothesPieceStitched;

    #[ORM\OneToMany(targetEntity: ClothesPieceStock::class, mappedBy: 'dressKeeper')]
    private $clothesPieces;

    public function __construct()
    {
        $this->families = new ArrayCollection();
        $this->memberShips = new ArrayCollection();
        $this->clothesPieceStitched = new ArrayCollection();
        $this->clothesPieces = new ArrayCollection();

        $this->bodyMeasurement = new BodyMeasurement();
    }

    public function __toString(): string
    {
        return $this->firstname .' '. $this->lastname;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(?string $mobilePhone): self
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getNiss(): ?string
    {
        return $this->niss;
    }

    public function setNiss(?string $niss): self
    {
        $this->niss = $niss;

        return $this;
    }

    public function getInsurer(): ?string
    {
        return $this->insurer;
    }

    public function setInsurer(?string $insurer): self
    {
        $this->insurer = $insurer;

        return $this;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getBodyMeasurement(): ?BodyMeasurement
    {
        if ($this->bodyMeasurement === null) {
            $this->bodyMeasurement = new BodyMeasurement();
        }

        return $this->bodyMeasurement;
    }

    public function setBodyMeasurement(BodyMeasurement $bodyMeasurement): self
    {
        $this->bodyMeasurement = $bodyMeasurement;

        return $this;
    }

    /**
     * @return Collection|MemberFamily[]
     */
    public function getFamilies()
    {
        return $this->families;
    }

    public function addFamily(MemberFamily $family): self
    {
        if (!$this->families->contains($family)) {
            $this->families[] = $family;
        }

        return $this;
    }

    public function removeFamily(MemberFamily $family): self
    {
        if ($this->families->contains($family)) {
            $this->families->removeElement($family);
        }

        return $this;
    }

    /**
     * @return Collection|MemberShip[]
     */
    public function getMemberShips()
    {
        return $this->memberShips;
    }

    public function addMemberShip(MemberShip $memberShip): self
    {
        if (!$this->memberShips->contains($memberShip)) {
            $this->memberShips[] = $memberShip;
            $memberShip->setMember($this);
        }

        return $this;
    }

    public function removeMemberShip(MemberShip $memberShip): self
    {
        if ($this->memberShips->contains($memberShip)) {
            $this->memberShips->removeElement($memberShip);
            // set the owning side to null (unless already changed)
            if ($memberShip->getMember() === $this) {
                $memberShip->setMember(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ClothesPieceStock[]
     */
    public function getClothesPieceStitched(): Collection
    {
        return $this->clothesPieceStitched;
    }

    public function addClothesPieceStitched(ClothesPieceStock $clothesPieceStitched): self
    {
        if (!$this->clothesPieceStitched->contains($clothesPieceStitched)) {
            $this->clothesPieceStitched[] = $clothesPieceStitched;
            $clothesPieceStitched->setDressMaker($this);
        }

        return $this;
    }

    public function removeClothesPieceStitched(ClothesPieceStock $clothesPieceStitched): self
    {
        if ($this->clothesPieceStitched->contains($clothesPieceStitched)) {
            $this->clothesPieceStitched->removeElement($clothesPieceStitched);
            // set the owning side to null (unless already changed)
            if ($clothesPieceStitched->getDressMaker() === $this) {
                $clothesPieceStitched->setDressMaker(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ClothesPieceStock[]
     */
    public function getClothesPieces(): Collection
    {
        return $this->clothesPieces;
    }

    public function addClothesPiece(ClothesPieceStock $clothesPiece): self
    {
        if (!$this->clothesPieces->contains($clothesPiece)) {
            $this->clothesPieces[] = $clothesPiece;
            $clothesPiece->setDressKeeper($this);
        }

        return $this;
    }

    public function removeClothesPiece(ClothesPieceStock $clothesPiece): self
    {
        if ($this->clothesPieces->contains($clothesPiece)) {
            $this->clothesPieces->removeElement($clothesPiece);
            // set the owning side to null (unless already changed)
            if ($clothesPiece->getDressKeeper() === $this) {
                $clothesPiece->setDressKeeper(null);
            }
        }

        return $this;
    }

    public function getAge(): ?int
    {
        if ($this->getBirthdate() === null) {
            return null;
        }

        $now = new \DateTime();
        $interval = $now->diff($this->getBirthdate());

        return $interval->y;
    }

    public function getExportData()
    {
        $address = $this->getAddress() ? $this->getAddress()->getExportData() : [];
        $family = [];
        if ($this->getFamilies() && count($this->getFamilies()) > 0) {
            $family = $this->getFamilies()->first()->getExportData();
        }
        $bodyMeasurement = $this->getBodyMeasurement() ? $this->getBodyMeasurement()->getExportData() : [];

        return \array_merge([
            '.PRENOM' => $this->firstname,
            '.NOM' => strtoupper($this->lastname),
            '.DATEN' => $this->birthdate ? $this->birthdate->format('d/m/Y') : '',
            '.AGE' => $this->getAge() ?? '',
            '.GENRE' => $this->sex,
            '.IDFEDE' => '',
            '.TYPEM' => 'Adhérent',
            '.GROUPE' => 'Clap\'Sabots',
            '.FONCTIONADM' => '',
            '.FONCTIONART' => '',
            '.GROUPEPRINCIPAL' => 'Clap\'Sabots',
            '.TEL' => $this->phone,
            '.GSM' => $this->mobilePhone,
            '.EMAIL' => $this->email,
        ], $address, $family, $bodyMeasurement);
    }
}
