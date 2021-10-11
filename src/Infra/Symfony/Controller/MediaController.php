<?php

declare(strict_types=1);

namespace Infra\Symfony\Controller;

use Infra\Symfony\Persistance\Doctrine\Entity\Playlist;
use Infra\Symfony\Persistance\Doctrine\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MediaController
 * @package App\Controller
 */
class MediaController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     * @Route("/media", name="app_media_index")
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function indexAction(EntityManagerInterface $em): Response
    {
        $videos = $em->getRepository(Video::class)->findLastVideos();
        $playlists = $em->getRepository(Playlist::class)->findLastPlaylists();

        $breadcrumb['items'][] = ['title' => 'Home', 'url' => '/'];
        $breadcrumb['items'][] = ['title' => 'Media'];

        return $this->render('media/index.html.twig', [
            'videos' => $videos,
            'playlists' => $playlists,
            'breadcrumb' => $this->getBreadcurmb()
        ]);
    }

    private function getBreadcurmb() {
        $breadcrumb['items'][] = ['title' => 'Home', 'url' => '/'];
        $breadcrumb['items'][] = ['title' => 'Media'];

        return $breadcrumb;
    }
}
