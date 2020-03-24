<?php

namespace App\Controller;

use App\Utils\SqlParameterBag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/*** @package App\Controller
 */
class BaseController extends AbstractController
{
    /** @var SqlParameterBag */
    private $sqlParameterBag;

    /** @var EntityManagerInterface */
    private $entityManager;


    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $this->sqlParameterBag  = new SqlParameterBag();
        $this->entityManager = $entityManager;

        /** @var Request|null request */
        if ($request = $requestStack->getCurrentRequest()) {
            $this->request = $request;
            $this->sqlParameterBag->setRequest($request);
        }
    }

    /**
     * @return SqlParameterBag
     */
    protected function getSqlParameterBag()
    {
        return $this->sqlParameterBag;
    }

    /**
     * @param SqlParameterBag $sqlParameterBag
     * @return $this
     */
    protected function setSqlParameterBag(SqlParameterBag $sqlParameterBag)
    {
        $this->sqlParameterBag = $sqlParameterBag;
        return $this;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManagerInterface $entityManager
     *
     * @return $this
     */
    public function setEntityManager(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }
}