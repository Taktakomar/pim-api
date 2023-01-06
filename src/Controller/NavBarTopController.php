<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavBarTopController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('nav_bar_top/index.html.twig', [
            'controller_name' => 'NavBarTopController',
        ]);
    }
}
