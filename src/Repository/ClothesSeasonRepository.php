<?php

namespace App\Repository;

use App\Entity\ClothesSeason;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClothesSeason|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClothesSeason|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClothesSeason[]    findAll()
 * @method ClothesSeason[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothesSeasonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClothesSeason::class);
    }

    // /**
    //  * @return ClothesSeason[] Returns an array of ClothesSeason objects
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
    public function findOneBySomeField($value): ?ClothesSeason
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
