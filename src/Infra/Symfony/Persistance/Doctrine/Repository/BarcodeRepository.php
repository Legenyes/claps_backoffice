<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Repository;

use Infra\Symfony\Persistance\Doctrine\Entity\Barcode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Barcode|null find($id, $lockMode = null, $lockVersion = null)
 * @method Barcode|null findOneBy(array $criteria, array $orderBy = null)
 * @method Barcode[]    findAll()
 * @method Barcode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarcodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Barcode::class);
    }
}
