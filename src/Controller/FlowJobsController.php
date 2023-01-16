<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FlowRepository;
use App\Repository\SftpRepository;
use App\Entity\Sftp;
use Doctrine\Persistence\ManagerRegistry;
use App\Controller\LogJobsController;
use Symfony\Component\HttpKernel\KernelInterface;

use App\Event\OrderPlacedEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class FlowJobsController extends AbstractController
{
    private $info = "";
    private $error ="";
    private $flowRepo;
    private $sftpRepo;
    private $doctrine;


    public function __construct(FlowRepository $flowRepo,SftpRepository $sftpRepo,ManagerRegistry $doctrine){
        $this->flowRepo=$flowRepo;
        $this->sftpRepo=$sftpRepo;
        $this->doctrine=$doctrine;
    
    }
    public  function createFileByFlowId($id,EventDispatcherInterface $eventDispatcher)
    {
       // $event = new OrderPlacedEvent();
        //$eventDispatcher->dispatch($event, OrderPlacedEvent::NAME);
        return $this->json("job gestartet",200);
    }
}
