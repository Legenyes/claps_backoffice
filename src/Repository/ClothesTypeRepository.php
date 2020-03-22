<?php

namespace App\Repository;

use App\Entity\ClothesType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ClothesType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClothesType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClothesType[]    findAll()
 * @method ClothesType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothesTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClothesType::class);
    }

    // /**
    //  * @return ClothesType[] Returns an array of ClothesType objects
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
    public function findOneBySomeField($value): ?ClothesType
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
