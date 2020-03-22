<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PlaylistRepository")
 */
class Playlist
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlaylistVideo", mappedBy="playlist", orphanRemoval=true, cascade={"persist"})
     */
    private $playlistVideos;

    public function __construct()
    {
        $this->playlistVideos = new ArrayCollection();
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

    /**
     * @return Collection|PlaylistVideo[]
     */
    public function getPlaylistVideos(): Collection
    {
        return $this->playlistVideos;
    }

    public function addPlaylistVideo(PlaylistVideo $playlistVideo): self
    {
        if (!$this->playlistVideos->contains($playlistVideo)) {
            $this->playlistVideos[] = $playlistVideo;
            $playlistVideo->setPlaylist($this);
        }

        return $this;
    }

    public function removePlaylistVideo(PlaylistVideo $playlistVideo): self
    {
        if ($this->playlistVideos->contains($playlistVideo)) {
            $this->playlistVideos->removeElement($playlistVideo);
            // set the owning side to null (unless already changed)
            if ($playlistVideo->getPlaylist() === $this) {
                $playlistVideo->setPlaylist(null);
            }
        }

        return $this;
    }
}
