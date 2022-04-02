<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="Infra\Symfony\Persistance\Doctrine\Repository\PlaylistVideoRepository")
 */
class PlaylistVideo implements \Stringable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $position = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\Playlist", inversedBy="playlistVideos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $playlist;

    /**
     * @ORM\ManyToOne(targetEntity="Infra\Symfony\Persistance\Doctrine\Entity\Video", inversedBy="playlistVideos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $video;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        $string = '';

        if ($this->getPlaylist()) {
            $string .= $this->getPlaylist()->getName() .' | ';
        }

        if ($this->getVideo()) {
            $string .= $this->getVideo()->getName();
        }

        return $string;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getPlaylist(): ?Playlist
    {
        return $this->playlist;
    }

    public function setPlaylist(?Playlist $playlist): self
    {
        $this->playlist = $playlist;

        return $this;
    }

    public function getVideo(): ?Video
    {
        return $this->video;
    }

    public function setVideo(?Video $video): self
    {
        $this->video = $video;

        return $this;
    }
}
