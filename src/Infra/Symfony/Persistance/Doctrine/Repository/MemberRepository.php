<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Repository;

use Infra\Symfony\Persistance\Doctrine\Entity\Member;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Infra\Symfony\Persistance\Doctrine\Entity\MemberFamily;

/**
 * @method Member|null find($id, $lockMode = null, $lockVersion = null)
 * @method Member|null findOneBy(array $criteria, array $orderBy = null)
 * @method Member[]    findAll()
 * @method Member[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Member::class);
    }

    public function findByFamily(MemberFamily $memberFamily)
    {
        return $this->createQueryBuilder('m')
            ->join('m.families', 'f')
            ->andWhere('f.id = :family')
            ->setParameter('family', $memberFamily->getId())
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param \Symfony\Component\Security\Core\User\User $user
     * @return QueryBuilder
     */
    public function filterByParentUser(\Symfony\Component\Security\Core\User\User $user): QueryBuilder
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.firstname LIKE :firstname')
            ->setParameter('firstname', '%'.$user->getUsername() .'%')
            ->setMaxResults(10)
            ;
    }
}
