<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Repository;

use Infra\Symfony\Persistance\Doctrine\Entity\ClothesOpportunity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClothesOpportunity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClothesOpportunity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClothesOpportunity[]    findAll()
 * @method ClothesOpportunity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothesOpportunityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClothesOpportunity::class);
    }

    // /**
    //  * @return ClothesOpportunity[] Returns an array of ClothesOpportunity objects
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
    public function findOneBySomeField($value): ?ClothesOpportunity
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
