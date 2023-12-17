<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\SectionRepository;

#[ApiResource]
#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $code = null;

    #[ORM\ManyToMany(targetEntity: MemberShip::class, mappedBy: 'sections')]
    private $memberShips;

    #[ORM\ManyToMany(targetEntity: Video::class, mappedBy: 'sections')]
    private $videos;

    public function __construct()
    {
        $this->memberShips = new ArrayCollection();
        $this->videos = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $memberShip->addSection($this);
        }

        return $this;
    }

    public function removeMemberShip(MemberShip $memberShip): self
    {
        if ($this->memberShips->contains($memberShip)) {
            $this->memberShips->removeElement($memberShip);
            $memberShip->removeSection($this);
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->addSection($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            $video->removeSection($this);
        }

        return $this;
    }
}
