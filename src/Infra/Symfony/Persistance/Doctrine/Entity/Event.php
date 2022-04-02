<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="Infra\Symfony\Persistance\Doctrine\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $venue = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHighlight;

    /**
     * @ORM\OneToMany(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\Video", mappedBy="event", cascade={"persist"})
     */
    private $videos;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName() ?? '';
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIsHighlight(): ?bool
    {
        return $this->isHighlight;
    }

    public function setIsHighlight(bool $isHighlight): self
    {
        $this->isHighlight = $isHighlight;

        return $this;
    }


    public function getVenue(): ?string
    {
        return $this->venue;
    }


    public function setVenue(?string $venue): self
    {
        $this->venue = $venue;

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
            $video->setEvent($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getEvent() === $this) {
                $video->setEvent(null);
            }
        }

        return $this;
    }
}
