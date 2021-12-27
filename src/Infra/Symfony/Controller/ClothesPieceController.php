<?php

declare(strict_types=1);

namespace Infra\Symfony\Controller;

use Infra\Symfony\Persistance\Doctrine\Entity\ClothesPiece;
use Infra\Symfony\Persistance\Doctrine\Repository\ClothesPieceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/clothes/pieces')]
class ClothesPieceController extends BaseController
{
    #[Route('/', name:'app_clothes_piece_index')]
    public function indexAction(ClothesPieceRepository $clothesPieceRepository): Response
    {
        $pieces = $clothesPieceRepository->findAll();

        return $this->render('clothespiece/index.html.twig', [
            'pieces' => $pieces,
            'breadcrumb' => null
        ]);
    }

    #[Route('/{id}', name:'app_clothes_piece_show', requirements: ['id' => '\d+'])]
    public function showAction(ClothesPiece $piece): Response
    {
        return $this->render('clothespiece/show.html.twig', [
            'piece' => $piece,
        ]);
    }
}
