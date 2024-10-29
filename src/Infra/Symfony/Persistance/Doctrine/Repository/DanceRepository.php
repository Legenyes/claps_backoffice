<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Repository;

use Infra\Symfony\Persistance\Doctrine\Entity\Dance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dance[]    findAll()
 * @method Dance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dance::class);
    }
}
