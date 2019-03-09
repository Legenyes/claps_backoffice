<?php

namespace App\Repository;

use App\Entity\ClothesOpportunity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClothesOpportunity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClothesOpportunity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClothesOpportunity[]    findAll()
 * @method ClothesOpportunity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothesOpportunityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
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
