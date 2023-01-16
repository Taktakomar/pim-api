<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FlowRepository;
use App\Repository\FlowProtokollRepository;
class FlowProtokollController extends AbstractController
{
    
    public function getProtokollByFlowId(FlowRepository $flowrep,FlowProtokollRepository $flowprotrep, $id): Response
    {
        $protokoll = null ;
        $flowname ="";
        $id = intval($id);
        if ($id){
            $flow = $flowrep->findOneBy(['id'=>$id]);
            $protokoll = $flowprotrep->findBy(['flow_id'=>$id],['protkoll_run_time'=>'desc']);
            $flowname = $flow->getDisplayName();
        }
        return $this->render('flow_protokoll/index.html.twig', [
            'protocols' => $protokoll,
            'flow_name'=>$flowname,
        ]);
    }
}
