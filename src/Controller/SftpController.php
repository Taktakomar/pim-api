<?php

namespace App\Controller;
use App\Entity\Sftp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SftpController extends AbstractController
{

    public function addSftp(Request $request ,ManagerRegistry $doctrine,UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($request->isMethod('POST')) {
            $account_name = $request->get('account_name');
            $server_name = $request->get('server_name');
            $server_port = $request->get('sftp_port');
            $user_name = $request->get('user_name');
            $user_password = $request->get('user_password');
            if ($account_name &&  $server_name && $server_port && $user_name && $user_password){
                $sftp = new Sftp();
                $sftp->setAccountName($account_name);
                $sftp->setServer($server_name);
                $sftp->setSeverPort($server_port);
                $sftp->setServerUserName($user_name);
                $sftp->setArt("sftp");
                //$pwd_peppered = hash_hmac("sha256", $user_password ,"pepper=".$this->getParameter('app.pepper'));
                //$pwd_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);
                $sftp->setServerPassword($user_password);
                $em = $doctrine->getManager();
                $em->persist($sftp);
                $em->flush();
                $this->addFlash('success','SFTP Account wurde erfolgreich erstellt!');
            }
            
        }
        return $this->render('sftp/index.html.twig', [
            'controller_name' => 'SftpController',
        ]);

    }
}
