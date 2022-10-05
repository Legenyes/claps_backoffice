<?php

declare(strict_types=1);

namespace Infra\Symfony\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Infra\Symfony\Persistance\Doctrine\Repository\BarcodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarcodeController extends AbstractController
{
    #[Route('/barcode', name:'app_barcode_index')]
    public function indexAction(): Response
    {
        return $this->render('barcode/index.html.twig', []);
    }

    #[Route('/barcode/scan', name:'app_barcode_scan')]
    public function scanAction(
        Request $request,
        BarcodeRepository $barcodeRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $barcodeValue = $request->request->get('barcodeValue');
        $barcode = $barcodeRepository->findOneByValue($barcodeValue);
        if ($barcode) {
            if ($barcode->isScanned()) {
                return new JsonResponse([
                    'value' => $barcodeValue,
                    'barcode' => $barcode,
                    'name' => $barcode->getAttendeeDisplayName(),
                    'scanned' => true
                ]);
            }

            $barcode->setScanned(true);
            $entityManager->persist($barcode);
            $entityManager->flush();
        }

        return new JsonResponse([
            'value' => $barcodeValue,
            'barcode' => $barcode,
            'name' => $barcode?->getAttendeeDisplayName(),]);
    }
}
