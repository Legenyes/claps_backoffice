<?php

declare(strict_types=1);

namespace Infra\Symfony\Controller;

use Infra\Symfony\Persistance\Doctrine\Repository\PlaylistRepository;
use Infra\Symfony\Persistance\Doctrine\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name:'app_index')]
    public function indexAction(VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findLastVideos(8);

        return $this->render('Home/index.html.twig', [
            'videos' => $videos,
            'breadcrumb' => $this->getBreadcurmb()
        ]);
    }

    private function getBreadcurmb(): array
    {
        $breadcrumb['items'][] = ['title' => 'Home', 'url' => '/'];

        return $breadcrumb;
    }
}
