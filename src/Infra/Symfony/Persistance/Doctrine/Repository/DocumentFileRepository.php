<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Infra\Symfony\Persistance\Doctrine\Entity\DocumentFile;

/**
 * @method DocumentFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentFile[]    findAll()
 * @method DocumentFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentFile::class);
    }
}
