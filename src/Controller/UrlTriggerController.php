<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FlowRepository;

class UrlTriggerController extends AbstractController
{
    public function showUrl(FlowRepository $flowrep): Response
    {
        $flows = $flowrep->findAll();
        return $this->render('url_trigger/index.html.twig', [
            'flows' => $flows,
        ]);
    }
}
