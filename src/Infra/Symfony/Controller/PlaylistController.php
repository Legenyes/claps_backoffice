<?php

declare(strict_types=1);

namespace Infra\Symfony\Controller;

use Infra\Symfony\Persistance\Doctrine\Entity\Playlist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/playlist")
 */
class PlaylistController extends AbstractController
{
    /**
     * @Route("/", name="app_playlist_index")
     */
    public function indexAction(EntityManagerInterface $em): Response
    {
        $playlists = $em->getRepository(Playlist::class)->findAll();

        return $this->render('playlist/index.html.twig', [
            'playlists' => $playlists
        ]);
    }
}
