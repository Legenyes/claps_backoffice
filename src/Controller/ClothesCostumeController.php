<?php

namespace App\Controller;

use App\Entity\ClothesCostume;
use App\Entity\Event;
use App\Entity\Section;
use App\Entity\Video;
use App\Form\Type\SearchVideoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClothesCostumeController
 * @Route("/clothes/costumes")
 * @package App\Controller
 */
class ClothesCostumeController extends BaseController
{
    /**
     * @Route("/", name="app_clothes_costume_index")
     * @param EntityManagerInterface $em
     *
     * @return Response
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