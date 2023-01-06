<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry;

class RegistrierungController extends AbstractController
{
    
    public function index(Request $request ,UserPasswordHasherInterface $passwordHasher ,ManagerRegistry $doctrine): Response
    {
        if ($request->isMethod('POST')) {
            $username = $request->get('userName');
            $password = $request->get('inputPassword');
            if ($username && $password){
                $user = new User();
                $user->setUsername($username);
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $password
                );
                $user->setPassword($hashedPassword);
                $em = $doctrine->getManager();
                $em->persist($user);
                $em->flush();
                return $this->redirect($this->generateUrl('app_login'));
            }
        }

        return $this->render('registrierung/index.html.twig', [
            'controller_name' => 'RegistrierungController',
        ]);
    }
}
