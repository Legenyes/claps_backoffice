<?php

namespace App\Repository;

use App\Entity\MemberShip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MemberShip|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberShip|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberShip[]    findAll()
 * @method MemberShip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberShipRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MemberShip::class);
    }

    // /**
    //  * @return MemberShip[] Returns an array of MemberShip objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MemberShip
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
