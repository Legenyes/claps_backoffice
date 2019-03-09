<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SectionRepository")
 */
class Section
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
     * @ORM\ManyToMany(targetEntity="App\Entity\MemberShip", mappedBy="sections")
     */
    private $memberShips;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $code;

    public function __construct()
    {
        $this->memberShips = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
}
