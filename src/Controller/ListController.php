<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\ArikelRepository;

class ListController extends AbstractFOSRestController
{

    public function getProductInfo(ArikelRepository $artikelrep, $id)
    {
        $artikel = $artikelrep->findBy([
            'artikelId' => $id,
        ]);
        return $this->json($artikel,200);
    }
}
