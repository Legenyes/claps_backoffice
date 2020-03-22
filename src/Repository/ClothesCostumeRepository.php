<?php

namespace App\Repository;

use App\Entity\ClothesCostume;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ClothesCostume|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClothesCostume|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClothesCostume[]    findAll()
 * @method ClothesCostume[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothesCostumeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClothesCostume::class);
    }

    // /**
    //  * @return ClothesCostume[] Returns an array of ClothesCostume objects
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
    public function findOneBySomeField($value): ?ClothesPiece
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
