<?php

namespace App\Repository;

use App\Entity\ClothesPiece;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ClothesPiece|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClothesPiece|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClothesPiece[]    findAll()
 * @method ClothesPiece[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothesPieceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClothesPiece::class);
    }

    // /**
    //  * @return ClothesPiece[] Returns an array of ClothesPiece objects
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
