<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Infra\Symfony\Persistance\Doctrine\Repository\BodyMeasurementRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BodyMeasurementRepository::class)]
class BodyMeasurement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    #[Assert\Range(min: 1, max: 50)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $neck = null;

    #[Assert\Range(min: 1, max: 100)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $bust = null;

    #[Assert\Range(min: 1, max: 100)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $underBust = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $waist = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $hips = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $thigh = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $calf = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $biceps = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $wrist = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $shoulder = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $armLength = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $bustHeight = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $shoulderToWaistFront = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $shoulderToWaistBack = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $backWidth = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $hipHeight = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $legLength = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $waistToFloor = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $neckToFloor = null;

    #[Assert\Range(min: 1, max: 200)]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $totalHeight = null;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getNeck(): ?int
    {
        return $this->neck;
    }

    public function setNeck(?int $neck): void
    {
        $this->neck = $neck;
    }

    public function getBust(): ?int
    {
        return $this->bust;
    }

    public function setBust(?int $bust): void
    {
        $this->bust = $bust;
    }

    public function getUnderBust(): ?int
    {
        return $this->underBust;
    }

    public function setUnderBust(?int $underBust): void
    {
        $this->underBust = $underBust;
    }

    public function getWaist(): ?int
    {
        return $this->waist;
    }

    public function setWaist(?int $waist): void
    {
        $this->waist = $waist;
    }

    public function getHips(): ?int
    {
        return $this->hips;
    }

    public function setHips(?int $hips): void
    {
        $this->hips = $hips;
    }

    public function getThigh(): ?int
    {
        return $this->thigh;
    }

    public function setThigh(?int $thigh): void
    {
        $this->thigh = $thigh;
    }

    public function getCalf(): ?int
    {
        return $this->calf;
    }

    public function setCalf(?int $calf): void
    {
        $this->calf = $calf;
    }

    public function getBiceps(): ?int
    {
        return $this->biceps;
    }

    public function setBiceps(?int $biceps): void
    {
        $this->biceps = $biceps;
    }

    public function getWrist(): ?int
    {
        return $this->wrist;
    }

    public function setWrist(?int $wrist): void
    {
        $this->wrist = $wrist;
    }

    public function getShoulder(): ?int
    {
        return $this->shoulder;
    }

    public function setShoulder(?int $shoulder): void
    {
        $this->shoulder = $shoulder;
    }

    public function getArmLength(): ?int
    {
        return $this->armLength;
    }

    public function setArmLength(?int $armLength): void
    {
        $this->armLength = $armLength;
    }

    public function getBustHeight(): ?int
    {
        return $this->bustHeight;
    }

    public function setBustHeight(?int $bustHeight): void
    {
        $this->bustHeight = $bustHeight;
    }

    public function getShoulderToWaistFront(): ?int
    {
        return $this->shoulderToWaistFront;
    }

    public function setShoulderToWaistFront(?int $shoulderToWaistFront): void
    {
        $this->shoulderToWaistFront = $shoulderToWaistFront;
    }

    public function getShoulderToWaistBack(): ?int
    {
        return $this->shoulderToWaistBack;
    }

    public function setShoulderToWaistBack(?int $shoulderToWaistBack): void
    {
        $this->shoulderToWaistBack = $shoulderToWaistBack;
    }

    public function getBackWidth(): ?int
    {
        return $this->backWidth;
    }

    public function setBackWidth(?int $backWidth): void
    {
        $this->backWidth = $backWidth;
    }

    public function getHipHeight(): ?int
    {
        return $this->hipHeight;
    }

    public function setHipHeight(?int $hipHeight): void
    {
        $this->hipHeight = $hipHeight;
    }

    public function getLegLength(): ?int
    {
        return $this->legLength;
    }

    public function setLegLength(?int $legLength): void
    {
        $this->legLength = $legLength;
    }

    public function getWaistToFloor(): ?int
    {
        return $this->waistToFloor;
    }

    public function setWaistToFloor(?int $waistToFloor): void
    {
        $this->waistToFloor = $waistToFloor;
    }

    public function getNeckToFloor(): ?int
    {
        return $this->neckToFloor;
    }

    public function setNeckToFloor(?int $neckToFloor): void
    {
        $this->neckToFloor = $neckToFloor;
    }

    public function getTotalHeight(): ?int
    {
        return $this->totalHeight;
    }

    public function setTotalHeight(?int $totalHeight): void
    {
        $this->totalHeight = $totalHeight;
    }

    public function getExportData(): array
    {
        return [
            'neck' => $this->getNeck(),
            'bust' => $this->getBust(),
            'underBust' => $this->getUnderBust(),
            'waist' => $this->getWaist(),
            'hips' => $this->getHips(),
            'thigh' => $this->getThigh(),
            'calf' => $this->getCalf(),
            'biceps' => $this->getBiceps(),
            'wrist' => $this->getWrist(),
            'shoulder' => $this->getShoulder(),
            'armLength' => $this->getArmLength(),
            'bustHeight' => $this->getBustHeight(),
            'shoulderToWaistFront' => $this->getShoulderToWaistFront(),
            'shoulderToWaistBack' => $this->getShoulderToWaistBack(),
            'backWidth' => $this->getBackWidth(),
            'hipHeight' => $this->getHipHeight(),
            'legLength' => $this->getLegLength(),
            'waistToFloor' => $this->getWaistToFloor(),
            'neckToFloor' => $this->getNeckToFloor(),
            'totalHeight' => $this->getTotalHeight(),
        ];
    }
}