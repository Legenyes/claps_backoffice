<?php

declare(strict_types=1);

namespace Infra\Symfony\Persistance\Doctrine\Repository;

use Infra\Symfony\Persistance\Doctrine\Entity\Video;
use Infra\Symfony\Utils\SqlParameterBag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    /**
     * @return Video[]
     */
    public function findLastVideos(?int $limit = 4)
    {
        return $this->createQueryBuilder('v')
            ->setMaxResults($limit)
            ->orderBy('v.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function getCountryList(): array
    {
        $result = $this->createQueryBuilder('v')
            ->select('v.country')
            ->distinct()
            ->getQuery()
            ->getArrayResult() ;

        $countries = [];
        foreach ($result as $i) {
            $countries[] = $i['country'];
        }

        return $countries;
    }

    private function filterAllQueryBuilder(SqlParameterBag $params): QueryBuilder
    {
        /** @var QueryBuilder $query */
        $query = $this->createQueryBuilder('video')
            ->leftJoin('video.sections', 'section')
            ->setFirstResult($params->getOffset())
            ->setMaxResults($params->getLimit());

        if ($params->has('search')) {
            $searchs = explode(" ", (string) $params->get('search'));
            foreach ($searchs as $key => $search) {
                $search = iconv('UTF-8','UTF-8//IGNORE', $search);
                $query
                    ->andWhere('video.name LIKE :search'.$key)
                    ->setParameter('search'.$key, '%'.$search.'%');
            }

        }

        if ($params->has('country') && strlen((string) $params->get('country'))>0) {
            $query
                ->andWhere('video.country = :country')
                ->setParameter('country', $params->get('country'));
        }

        if ($params->has('event') && strlen((string) $params->get('event'))>0) {
            $query
                ->andWhere('video.event = :event')
                ->setParameter('event', $params->get('event'));
        }

        if ($params->has('sections') && strlen((string) $params->get('sections'))>0) {
            $query
                ->andWhere('section.id = :sections')
                ->setParameter('sections', $params->get('sections'));
        }

        foreach($params->getOrderBy() as $key=>$value)
            $query->addOrderBy("video.".$key, $value);

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
