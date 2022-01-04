<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Infra\Symfony\Persistance\Doctrine\Entity\DocumentCategory;

/**
 * @method DocumentCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentCategory[]    findAll()
 * @method DocumentCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentCategory::class);
    }
}
