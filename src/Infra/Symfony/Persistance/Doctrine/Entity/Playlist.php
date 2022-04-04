<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\PlaylistRepository;

#[ApiResource]
#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    #[ORM\OneToMany(targetEntity: PlaylistVideo::class, mappedBy: 'playlist', orphanRemoval: true, cascade: ['persist'])]
    private $playlistVideos;

    public function __construct()
    {
        $this->playlistVideos = new ArrayCollection();
    }

    public function __toString(): string
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
