<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 */
class Member
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mobilePhone;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $sex;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $niss;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $insurer;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist", "remove"})
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MemberShip", mappedBy="member", orphanRemoval=true)
     */
    private $memberShips;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClothesPieceStock", mappedBy="dressMaker")
     */
    private $clothesPieceStitched;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClothesPieceStock", mappedBy="dressKeeper")
     */
    private $clothesPieces;

    public function __construct()
    {
        $this->memberShips = new ArrayCollection();
        $this->clothesPieceStitched = new ArrayCollection();
        $this->clothesPieces = new ArrayCollection();
    }

    public function __toString()
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

    public function getExportData()
    {
        $address = $this->getAddress() ? $this->getAddress()->getExportData() : [];

        return \array_merge([
            '.PRENOM' => $this->firstname,
            '.NOM' => $this->lastname,
            '.DATEN' => $this->birthdate ? $this->birthdate->format('d/m/Y') : '',
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
        ], $address);
    }
}
