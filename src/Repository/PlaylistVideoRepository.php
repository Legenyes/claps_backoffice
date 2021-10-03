<?php

namespace App\Repository;

use App\Entity\PlaylistVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlaylistVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaylistVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaylistVideo[]    findAll()
 * @method PlaylistVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaylistVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaylistVideo::class);
    }

    // /**
    //  * @return PlaylistVideo[] Returns an array of PlaylistVideo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlaylistVideo
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
