<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlowConnectionController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('flow_connection/index.html.twig', [
            'controller_name' => 'FlowConnectionController',
        ]);
    }
}
