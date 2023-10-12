<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Repository;

use Infra\Symfony\Persistance\Doctrine\Entity\BodyMeasurement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BodyMeasurement|null find($id, $lockMode = null, $lockVersion = null)
 * @method BodyMeasurement|null findOneBy(array $criteria, array $orderBy = null)
 * @method BodyMeasurement[]    findAll()
 * @method BodyMeasurement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BodyMeasurementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BodyMeasurement::class);
    }
}
