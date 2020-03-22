<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MediaController
 * @Route("/media")
 * @package App\Controller
 */
class MediaController extends AbstractController
{
    /**
     * @Route("/", name="app_media_index")
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function indexAction(EntityManagerInterface $em): Response
    {
        $videos = $em->getRepository(Video::class)->findLastVideos();
        $playlists = $em->getRepository(Playlist::class)->findLastPlaylists();

        return $this->render('media/index.html.twig', [
            'videos' => $videos,
            'playlists' => $playlists
        ]);
    }
}