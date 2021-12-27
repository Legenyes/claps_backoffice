<?php

declare(strict_types=1);

namespace Infra\Symfony\Controller;

use Infra\Symfony\Form\Type\SearchClothesPieceType;
use Infra\Symfony\Form\Type\SearchVideoType;
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
        $form = $this->createForm(SearchClothesPieceType::class);
        $pieces = $clothesPieceRepository->filterAll($this->getSqlParameterBag());

        return $this->render('clothespiece/index.html.twig', [
            'pieces' => $pieces,
            'searchClothesPieceform' => $form->createView(),
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
