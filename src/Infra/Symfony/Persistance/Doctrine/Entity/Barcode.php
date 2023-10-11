<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\BarcodeRepository;
use Symfony\Component\String\Slugger\AsciiSlugger;
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

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $category = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $price = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $seat = null;

    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: 'barcode', cascade: ['persist'])]
    private $event;

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
        $slugger = new AsciiSlugger();
        $filename = $slugger->slug($this->getEvent()?->getName());
        $filename .= "-". $slugger->slug($this->getAttendeeDisplayName());
        if ($this->getSeat() !== null) {
            $filename .= "-". $slugger->slug($this->getSeat());
        }

        return sprintf("%s.pdf", $filename);
    }

    public function getAttendeeDisplayName(): string
    {
        return $this->getLastname(). " " . $this->getFirstname();
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }


    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    public function getSeat(): ?string
    {
        return $this->seat;
    }

    public function setSeat(?string $seat): void
    {
        $this->seat = $seat;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }
}
