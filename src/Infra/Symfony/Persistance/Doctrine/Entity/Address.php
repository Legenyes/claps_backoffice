<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="Infra\Symfony\Persistance\Doctrine\Repository\AddressRepository")
 */
class Address
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
    private $street;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $streetNumber;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $streetBox;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $country;


    public function __toString()
    {
        return $this->getFirstLine() .", ". $this->zipCode .' '. $this->city .', '. $this->country;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(?string $streetNumber): self
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    public function getStreetBox(): ?string
    {
        return $this->streetBox;
    }

    public function setStreetBox(?string $streetBox): self
    {
        $this->streetBox = $streetBox;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getFirstLine(): string
    {
        $line = $this->street ?? '';
        if ($this->streetNumber) {
            $line .= " ". $this->streetNumber;
        }
        if ($this->streetBox) {
            $line .= "/". $this->streetBox;
        }

        return $line;
    }

    public function getExportData()
    {
        return \array_merge([
            '.ADRESSE' => $this->getFirstLine(),
            '.CP' => $this->zipCode,
            '.LOCALITE' => $this->city,
        ]);
    }
}
