<?php

declare(strict_types=1);

namespace Infra\Symfony\Controller;

use Infra\Symfony\Persistance\Doctrine\Entity\ClothesCostume;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/clothes/costumes")
 */
class ClothesCostumeController extends BaseController
{
    /**
     * @Route("/", name="app_clothes_costume_index")
     */
    public function indexAction(EntityManagerInterface $em): Response
    {
        $costumes = $em->getRepository(ClothesCostume::class)->findAll();

        return $this->render('clothescostume/index.html.twig', [
            'costumes' => $costumes,
            'breadcrumb' => null
        ]);
    }

}
