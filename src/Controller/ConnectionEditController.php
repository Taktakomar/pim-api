<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnectionEditController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('connection_edit/index.html.twig', [
            'controller_name' => 'ConnectionEditController',
        ]);
    }
}
