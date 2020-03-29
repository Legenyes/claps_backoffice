<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Section;
use App\Entity\Video;
use App\Form\Type\SearchVideoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class VideoController
 * @Route("/video")
 * @package App\Controller
 */
class VideoController extends BaseController
{
    /**
     * @Route("/", name="app_video_index")
     * @param EntityManagerInterface $em
     *
     * @return Response
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
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function searchAction(Request $request, EntityManagerInterface $em): Response
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
     *
     * @param Video $video
     * @return Response
     */
    public function showAction(Video $video): Response
    {
        return $this->render('video/show.html.twig', [
            'video' => $video,
            'breadcrumb' => $this->getBreadcurmb()
        ]);
    }

    private function getBreadcurmb() {
        $breadcrumb['items'][] = ['title'=> 'Home', 'url' => '/'];
        $breadcrumb['items'][] = ['title'=> 'Media', 'url' => $this->generateUrl('app_media_index')];
        $breadcrumb['items'][] = ['title'=> 'Video'];

        return $breadcrumb;
    }

}