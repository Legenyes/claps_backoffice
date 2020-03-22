<?php

namespace App\Repository;

use App\Entity\ClothesTexture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ClothesTexture|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClothesTexture|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClothesTexture[]    findAll()
 * @method ClothesTexture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothesTextureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClothesTexture::class);
    }

    // /**
    //  * @return ClothesTexture[] Returns an array of ClothesTexture objects
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
    public function findOneBySomeField($value): ?ClothesTexture
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
