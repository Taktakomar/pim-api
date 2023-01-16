<?php

namespace App\Controller;
use App\Entity\Flow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\VerbindungenArtenRepository;
use App\Repository\SftpRepository;
use App\Repository\FlowRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class FlowsController extends AbstractController
{

    public function index(FlowRepository $flowrep): Response
    {
        $flows = $flowrep->findAll();
        return $this->render('flows/index.html.twig', [
            'flows' => $flows,
        ]);
    }
    public function startFlow(Request $request,FlowRepository $flowrep ,ManagerRegistry $doctrine ,$id): Response
    {
        $id = intVal($id);
        if ($request){
            if ($id){
                $flowTostart = $flowrep->findOneBy(['id'=>$id]);
                if($flowTostart->isActiv() == False){
                    $flowTostart->setActiv(True);
                    date_default_timezone_set("Europe/Berlin");
                    $flowTostart->setLastRunTime(new \DateTime('now'));
                    $em = $doctrine->getManager();
                    $em->persist( $flowTostart);
                    $em->flush();
                    $this->addFlash('success','Flow wurde Erfolgreich gestartet!');
                }else{
                    $this->addFlash('error','Flow ist bereit gestartet!');
                }
            }
        }
        $flows = $flowrep->findAll();
        return $this->render('flows/index.html.twig', [
            'flows' => $flows,
        ]);
    }
    public function stopFlow(Request $request,FlowRepository $flowrep ,ManagerRegistry $doctrine ,$id): Response
    {
        $id = intVal($id);
        if ($request){
            if ($id){
                $flowTostart = $flowrep->findOneBy(['id'=>$id]);
                if($flowTostart->isActiv() == True){
                    $flowTostart->setActiv(False);
                    $em = $doctrine->getManager();
                    $em->persist( $flowTostart);
                    $em->flush();
                    $this->addFlash('success','Flow wurde Erfolgreich gestoppt!');
                }else{
                    $this->addFlash('error','Flow ist bereit gestoppt!');
                }
            }
        }
        $flows = $flowrep->findAll();
        return $this->render('flows/index.html.twig', [
            'flows' => $flows,
        ]);
    }
    public function takeSuccess(Request $request,FlowRepository $flowrep ,ManagerRegistry $doctrine ,$id): Response
    {
        $id = intVal($id);
        if ($request){
            if ($id){
                $flowToSuccess = $flowrep->findOneBy(['id'=>$id]);
                if($flowToSuccess->getLastRunLog() == "ERROR"){
                    $flowToSuccess->setLastRunLog("OK");
                    $em = $doctrine->getManager();
                    $em->persist( $flowToSuccess);
                    $em->flush();
                    $this->addFlash('success','Flow wurde Erfolgreich auf Success gesetzt!');
                }else{
                    $this->addFlash('error','Flow ist bereit auf Success gesetzt!');
                }
            }
        }
        $flows = $flowrep->findAll();
        return $this->render('flows/index.html.twig', [
            'flows' => $flows,
        ]);
    }
    public function addFlow(Request $request,VerbindungenArtenRepository $verbindungsartenrep,SftpRepository $sftpRepo ,ManagerRegistry $doctrine): Response
    {
        $verbindungen = $verbindungsartenrep->findAll();
        $sftps = $sftpRepo->findAll();
        if ($request->isMethod('POST')) {

            $display_name = trim($request->get('display_name'));
            $context_name = trim ($request->get('context_name'));
            $period = trim($request->get('period'));
            $verbinungArtEingangId = trim($request->get('verbinungArtEingang'));
            $verbinungArtAusgangId = trim ($request->get('verbinungArtAusgang'));
            $sftpsIn =  trim($request->get('sftpsIn'));
            $sftpsOut =  trim($request->get('sftpsOut'));
            $input_datei_name = trim( $request->get('input_datei_name'));
            $output_datei_name =  trim($request->get('output_datei_name'));
            $Flow_Mappe =  trim($request->get('Flow_Mappe'));

            if ($display_name && $context_name && $period && $verbinungArtEingangId && 
                $verbinungArtAusgangId && $sftpsIn && $sftpsOut && $input_datei_name &&
                $output_datei_name && $Flow_Mappe){

                    $verbindungIn = $verbindungsartenrep->findOneBy(['id'=>$verbinungArtEingangId]);
                    $verbindungOut = $verbindungsartenrep->findOneBy(['id'=>$verbinungArtAusgangId]);
                    $sftpIn = $sftpRepo->findOneBy(['id'=>$sftpsIn]);
                    $sftpOut = $sftpRepo->findOneBy(['id'=>$sftpsOut]);
                    
                    $flow = new Flow();
                    $flow->setDisplayName($display_name);
                    $flow->setContextName($context_name);
                    $flow->setPeriodeInMin($period);
                    $flow->setVerbindungArtIdIn($verbindungIn);
                    $flow->setVerbinungartout($verbindungOut);
                    $flow->setVerbinungartout($verbindungOut);
                    $flow->setSftpInputServerId($sftpIn);
                    $flow->setSftpOutputServerId($sftpOut);
                    $flow->setInputDateiName($input_datei_name);
                    $flow->setOutputDateiName($output_datei_name);
                    $flow->setFlowMappe(str_replace("\r\n","",$Flow_Mappe));
                    date_default_timezone_set("Europe/Berlin");
                    $flow->setLastRunTime(new \DateTime('now'));
                    $em = $doctrine->getManager();
                    $em->persist($flow);
                    $em->flush();
                    $Flowid = $flow->getId();
                    $endPoint ="home/flows/stfpIn/sftpOut/createFileByFlowId/".$Flowid."";
                    $flow->setEndpointString($endPoint);
                    $em->persist($flow);
                    $em->flush();
                    $this->addFlash('success','Flow wurde Erfolgreich Erstellt!');
                  
            }
        }
        return $this->render('flows/add.html.twig', [
            'verbindungen' => $verbindungen,
            'sftps' => $sftps,
        ]);
    }
    public function createFileByFlowId(Request $request,FlowRepository $flowrep ,ManagerRegistry $doctrine ,$id)
    {

    }
}
