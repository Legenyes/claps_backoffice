<?php

namespace App\Repository;

use App\Entity\Video;
use App\Utils\SqlParameterBag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
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
     * @param int $limit
     *
     * @return Video[]
     */
    public function findLastVideos($limit = 4)
    {
        return $this->createQueryBuilder('v')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param SqlParameterBag $params
     * @return QueryBuilder
     */
    private function filterAllQueryBuilder(SqlParameterBag $params)
    {
        /** @var QueryBuilder $query */
        $query = $this->createQueryBuilder('video')
            ->leftJoin('video.sections', 'section')
            ->setFirstResult($params->getOffset())
            ->setMaxResults($params->getLimit());

        if ($params->has('search')) {
            $search = iconv('UTF-8','UTF-8//IGNORE', $params->get('search'));

            $query
                ->andWhere('video.name LIKE :search')
                ->setParameter('search', '%'.$search.'%');
        }

        if ($params->has('country') && strlen($params->get('country'))>0) {
            $query
                ->andWhere('video.country = :country')
                ->setParameter('country', $params->get('country'));
        }

        if ($params->has('event') && strlen($params->get('event'))>0) {
            $query
                ->andWhere('video.event = :event')
                ->setParameter('event', $params->get('event'));
        }

        if ($params->has('section') && strlen($params->get('section'))>0) {
            $query
                ->andWhere('section.id = :section')
                ->setParameter('section', $params->get('section'));
        }

        foreach($params->getOrderBy() as $key=>$value)
            $query->addOrderBy("video.".$key, $value);

        return $query;
    }

    /**
     * @param SqlParameterBag $params
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
