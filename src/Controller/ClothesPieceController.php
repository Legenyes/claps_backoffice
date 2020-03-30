<?php

namespace App\Controller;

use App\Entity\ClothesPiece;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClothesCostumeController
 * @Route("/clothes/pieces")
 * @package App\Controller
 */
class ClothesPieceController extends BaseController
{
    /**
     * @Route("/", name="app_clothes_piece_index")
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function indexAction(EntityManagerInterface $em): Response
    {
        $pieces = $em->getRepository(ClothesPiece::class)->findAll();

        return $this->render('clothespiece/index.html.twig', [
            'pieces' => $pieces,
            'breadcrumb' => null
        ]);
    }

    /**
     * @Route("/{id}", name="app_clothes_piece_show", requirements={"id"="\d+"})
     *
     * @param ClothesPiece $piece
     * @return Response
     */
    public function showAction(ClothesPiece $piece): Response
    {
        return $this->render('clothespiece/show.html.twig', [
            'piece' => $piece,
        ]);
    }

}