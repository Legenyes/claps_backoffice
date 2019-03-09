<?php

namespace App\Repository;

use App\Entity\ClubYear;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClubYear|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClubYear|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClubYear[]    findAll()
 * @method ClubYear[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubYearRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClubYear::class);
    }

    // /**
    //  * @return ClubYear[] Returns an array of ClubYear objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClubYear
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
