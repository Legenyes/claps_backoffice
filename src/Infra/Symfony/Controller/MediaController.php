<?php

declare(strict_types=1);

namespace Infra\Symfony\Controller;

use Infra\Symfony\Persistance\Doctrine\Repository\PlaylistRepository;
use Infra\Symfony\Persistance\Doctrine\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediaController extends AbstractController
{
    #[Route('/', name:'app_index')]
    #[Route('/media', name:'app_media_index')]
    public function indexAction(VideoRepository $videoRepository, PlaylistRepository $playlistRepository): Response
    {
        $videos = $videoRepository->findLastVideos();
        $playlists = $playlistRepository->findLastPlaylists();

        $breadcrumb['items'][] = ['title' => 'Home', 'url' => '/'];
        $breadcrumb['items'][] = ['title' => 'Media'];

        return $this->render('media/index.html.twig', [
            'videos' => $videos,
            'playlists' => $playlists,
            'breadcrumb' => $this->getBreadcurmb()
        ]);
    }

    private function getBreadcurmb(): array
    {
        $breadcrumb['items'][] = ['title' => 'Home', 'url' => '/'];
        $breadcrumb['items'][] = ['title' => 'Media'];

        return $breadcrumb;
    }
}
