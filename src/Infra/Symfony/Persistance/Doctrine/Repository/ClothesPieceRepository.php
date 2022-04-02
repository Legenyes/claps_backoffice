<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Repository;

use Doctrine\ORM\QueryBuilder;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesPiece;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Infra\Symfony\Utils\SqlParameterBag;

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

    public function search()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.country', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return QueryBuilder
     */
    private function filterAllQueryBuilder(SqlParameterBag $params)
    {
        /** @var QueryBuilder $query */
        $query = $this->createQueryBuilder('cp')
            ->leftJoin('cp.sections', 'section')
            ->setFirstResult($params->getOffset())
            ->setMaxResults($params->getLimit());

        if ($params->has('search')) {
            $searchs = explode(" ", $params->get('search'));
            foreach ($searchs as $key => $search) {
                $search = iconv('UTF-8','UTF-8//IGNORE', $search);
                $query
                    ->andWhere('cp.name LIKE :search'.$key)
                    ->setParameter('search'.$key, '%'.$search.'%');
            }

        }

        if ($params->has('country') && strlen($params->get('country'))>0) {
            $query
                ->andWhere('cp.country = :country')
                ->setParameter('country', $params->get('country'));
        }

        if ($params->has('sections') && strlen($params->get('sections'))>0) {
            $query
                ->andWhere('section.id = :sections')
                ->setParameter('sections', $params->get('sections'));
        }

        $query->addOrderBy("cp.country", "ASC");
        foreach($params->getOrderBy() as $key=>$value) {
            $query->addOrderBy("cp.".$key, $value);
        }

        return $query;
    }

    /**
     * @return mixed
     */
    public function filterAll(SqlParameterBag $params)
    {
        return $this
            ->filterAllQueryBuilder($params)
            ->getQuery()
            ->getResult();
    }

}
