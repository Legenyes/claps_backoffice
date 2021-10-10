<?php

namespace App\Repository;

use App\Entity\ClubYear;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClubYear|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClubYear|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClubYear[]    findAll()
 * @method ClubYear[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubYearRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClubYear::class);
    }

    public function findCurrentYear(): ClubYear
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.isActive = 1')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
