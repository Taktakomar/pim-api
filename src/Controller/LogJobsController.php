<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FlowProtokoll;
use Doctrine\Persistence\ManagerRegistry;
class LogJobsController extends AbstractController
{
    public function LogIntoDatabase($text,$flow,ManagerRegistry $doctrine,$logsuccess)
    {
        if (($flow)){
            if (trim($text) !=""){
                $flowProtcol = new FlowProtokoll();
                $flowProtcol->setFlowId($flow);
                date_default_timezone_set("Europe/Berlin");
                $flowProtcol->setProtkollRunTime(new \DateTime('now'));
                $flowProtcol->setLogInfo($text);
                $flowProtcol->setLogErrorOrSucces($logsuccess);
                $em = $doctrine->getManager();
                $em->persist($flowProtcol);
                $em->flush();
            }
        }
        
    }
}
