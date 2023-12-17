<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\MemberFamilyRepository;

#[ApiResource]
#[ORM\Entity(repositoryClass: MemberFamilyRepository::class)]
class MemberFamily implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $motherEmail = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $motherMobilePhone = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $fatherEmail = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $fatherMobilePhone = null;

    #[ORM\ManyToMany(targetEntity: Member::class, mappedBy: 'families')]
    private $famillyMembers;

    public function __construct()
    {
        $this->famillyMembers = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->lastname ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMotherEmail(): ?string
    {
        return $this->motherEmail;
    }

    public function setMotherEmail(?string $motherEmail): self
    {
        $this->motherEmail = $motherEmail;

        return $this;
    }

    public function getMotherMobilePhone(): ?string
    {
        return $this->motherMobilePhone;
    }

    public function setMotherMobilePhone(?string $motherMobilePhone): self
    {
        $this->motherMobilePhone = $motherMobilePhone;

        return $this;
    }

    public function getFatherEmail(): ?string
    {
        return $this->fatherEmail;
    }

    public function setFatherEmail(?string $fatherEmail): self
    {
        $this->fatherEmail = $fatherEmail;

        return $this;
    }

    public function getFatherMobilePhone(): ?string
    {
        return $this->fatherMobilePhone;
    }

    public function setFatherMobilePhone(?string $fatherMobilePhone): self
    {
        $this->fatherMobilePhone = $fatherMobilePhone;

        return $this;
    }

    public function getFamillyMembers()
    {
        return $this->famillyMembers;
    }

    public function getExportData()
    {
        return [
            '.EMAILMAMAN' => $this->motherEmail,
            '.EMAILPAPA' => $this->fatherEmail,
            '.GSMMAMAN' => $this->motherMobilePhone,
            '.GSMPAPA' => $this->fatherMobilePhone,
        ];
    }
}
