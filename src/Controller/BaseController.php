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
    private SqlParameterBag $sqlParameterBag;
    private EntityManagerInterface $entityManager;


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

    protected function getSqlParameterBag(): SqlParameterBag
    {
        return $this->sqlParameterBag;
    }

    protected function setSqlParameterBag(SqlParameterBag $sqlParameterBag): self
    {
        $this->sqlParameterBag = $sqlParameterBag;

        return $this;
    }

    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    public function setEntityManager(EntityManagerInterface $entityManager): self
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}
