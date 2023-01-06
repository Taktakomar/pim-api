<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlowProtokollController extends AbstractController
{
    
    public function index(): Response
    {
        return $this->render('flow_protokoll/index.html.twig', [
            'controller_name' => 'FlowProtokollController',
        ]);
    }
}
