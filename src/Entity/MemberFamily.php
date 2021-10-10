<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MemberFamilyRepository")
 */
class MemberFamily
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
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motherEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motherMobilePhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fatherEmail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fatherMobilePhone;

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
}
