<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Repository;

use Infra\Symfony\Persistance\Doctrine\Entity\MemberFamily;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MemberFamily|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberFamily|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberFamily[]    findAll()
 * @method MemberFamily[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberFamilyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MemberFamily::class);
    }
}
