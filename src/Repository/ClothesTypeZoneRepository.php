<?php

namespace App\Repository;

use App\Entity\ClothesTypeZone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClothesTypeZone|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClothesTypeZone|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClothesTypeZone[]    findAll()
 * @method ClothesTypeZone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothesTypeZoneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClothesTypeZone::class);
    }

    // /**
    //  * @return ClothesTypeZone[] Returns an array of ClothesTypeZone objects
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
    public function findOneBySomeField($value): ?ClothesTypeZone
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
