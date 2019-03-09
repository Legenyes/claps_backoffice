<?php

namespace App\Repository;

use App\Entity\ClothesTypeType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClothesTypeType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClothesTypeType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClothesTypeType[]    findAll()
 * @method ClothesTypeType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothesTypeTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClothesTypeType::class);
    }

    // /**
    //  * @return ClothesTypeType[] Returns an array of ClothesTypeType objects
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
    public function findOneBySomeField($value): ?ClothesTypeType
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
