<?php

declare(strict_types=1);

namespace Infra\Symfony\Controller;

use Infra\Symfony\Persistance\Doctrine\Entity\Video;
use Infra\Symfony\Form\Type\SearchVideoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/video")
 */
class VideoController extends BaseController
{
    /**
     * @Route("/", name="app_video_index")
     */
    public function indexAction(EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SearchVideoType::class);
        $videos = $em->getRepository(Video::class)->findAll();

        return $this->render('video/index.html.twig', [
            'videos' => $videos,
            'searchVideoform' => $form->createView(),
            'breadcrumb' => $this->getBreadcurmb()
        ]);
    }

    /**
     * @Route("/search", name="app_video_search")
     */
    public function searchAction(EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SearchVideoType::class);
        $videos = $em->getRepository(Video::class)->filterAll($this->getSqlParameterBag());

        return $this->render('video/search.html.twig', [
            'videos' => $videos,
            'searchVideoform' => $form->createView(),
            'breadcrumb' => $this->getBreadcurmb()
        ]);
    }

    /**
     * @Route("/{id}", name="app_video_show", requirements={"id"="\d+"})
     */
    public function showAction(Video $video): Response
    {
        return $this->render('video/show.html.twig', [
            'video' => $video,
            'breadcrumb' => $this->getBreadcurmb()
        ]);
    }

    private function getBreadcurmb(): array
    {
        $breadcrumb['items'][] = ['title'=> 'Home', 'url' => '/'];
        $breadcrumb['items'][] = ['title'=> 'Media', 'url' => $this->generateUrl('app_media_index')];
        $breadcrumb['items'][] = ['title'=> 'Video'];

        return $breadcrumb;
    }

}
