<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Repository;

use Infra\Symfony\Persistance\Doctrine\Entity\ClothesCostume;
use Infra\Symfony\Persistance\Doctrine\Entity\ClubYear;
use Infra\Symfony\Persistance\Doctrine\Entity\MemberShip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MemberShip|null find($id, $lockMode = null, $lockVersion = null)
 * @method MemberShip|null findOneBy(array $criteria, array $orderBy = null)
 * @method MemberShip[]    findAll()
 * @method MemberShip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberShipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MemberShip::class);
    }

    public function findForCostumeAssignation(ClubYear $year, ClothesCostume $costume): array
    {
        $query = $this->createQueryBuilder('m')
            ->join('m.member', 'mem')
            ->join('m.sections', 'section')
            ->andWhere('m.clubYear = :year')
            ->andWhere('mem.sex IN (:genders)')
            ->andWhere('section IN (:sections)')
            ->setParameter('year', $year)
            ->setParameter('genders', $costume->getGender())
            ->setParameter('sections', $costume->getSections())
        ;

        return $query->getQuery()->getResult();
    }
}
