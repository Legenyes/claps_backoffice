<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\BarcodeRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity(repositoryClass: BarcodeRepository::class)]
class Barcode implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::GUID, length: 255, unique: true)]
    private string $value;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $scanned = false;

    #[Assert\Email]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $lastname = null;

    public function __construct()
    {
        $this->value = self::generateUuid();
    }

    public static function generateUuid(): string
    {
        $uuid = \uuid_create(UUID_TYPE_RANDOM);
        $uuid = substr($uuid, 0,27);
        if ($uuid === null) {
            throw new \UnexpectedValueException("Null is not a valid UUID for ItemStockMovement");
        }

        return $uuid;
    }

    public function __toString(): string
    {
	    return $this->value;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function isScanned(): bool
    {
        return $this->scanned;
    }

    public function setScanned(bool $scanned): self
    {
        $this->scanned = $scanned;

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

    public function getPdfFileName(): string
    {
        return sprintf("bc-%d.pdf", $this->id);
    }

    public function getAttendeeDisplayName(): string
    {
        return $this->getFirstname() ." ". $this->getLastname();
    }
}
