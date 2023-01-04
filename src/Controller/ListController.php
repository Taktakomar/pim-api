<?php

namespace App\Controller;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ArikelRepository;
use App\Repository\KundenRepository;
use App\Repository\KundenDefintionenRepository;
use App\Repository\KollektionRepository;
use App\Repository\KategorieRepository;
use App\Repository\ImagesRepository;
use App\Repository\FarbeRepository;
use App\Repository\DefintionenRepository;
use App\Repository\ArtikelRepository;
use App\Repository\ArtikelDefintionenRepository;
class ListController extends AbstractFOSRestController
{

    public function getAllProduct(ArikelRepository $artikelrep):JsonResponse
    {
        $artikels = $artikelrep->findAll();
        return $this->json($artikels,200);
    }
    public function getKundenInforamtion(KundenRepository $kundenrepo):JsonResponse
    {
        $kunden = $kundenrepo->findAll();
        return $this->json($kunden,200);
    }
    public function getKundenTemplate(KundenDefintionenRepository $kunddefrepo):JsonResponse
    {
        $kundenDefintionen = $kunddefrepo->findAll();
        return $this->json($kundenDefintionen,200);
    }
    public function getkollektionen(KollektionRepository $kollektionrepo):JsonResponse
    {
        $kollektionen = $kollektionrepo->findAll();
        return $this->json($kollektionen,200);
    }
    public function getkategorien(KategorieRepository $kategorierepo):JsonResponse
    {
        $kategorien = $kategorierepo->findAll();
        return $this->json($kategorien,200);
    }
    public function getAllImages(ImagesRepository $kategorierepo):JsonResponse
    {
        $images = $kategorierepo->findAll();
        return $this->json($images,200);
    }
    public function getFarbe(FarbeRepository $farberepo):JsonResponse
    {
        $farben = $farberepo->findAll();
        return $this->json($farben,200);
    }
    public function getAllDefinitionen(DefintionenRepository $defintionenrepo):JsonResponse
    {
        $defintionen = $defintionenrepo->findAll();
        return $this->json($defintionen,200);
    }
    public function getAllArikelDefintionen(ArtikelDefintionenRepository $artikelDefintionRepo):JsonResponse
    {
        $artikelDefintionen = $artikelDefintionRepo->findAll();
        return $this->json($artikelDefintionen,200);
    }
    public function createCsvBycustomersName(
                    KundenRepository $kundenrepo,
                    KundenDefintionenRepository $kundendefRep,
                    ArtikelRepository $artRep,
                    ArtikelDefintionenRepository $artikelDefintionRepo,
                    ManagerRegistry $doctrine,
                    $name
                    ):JsonResponse{
                       
        $kunden = $kundenrepo->findOneBy(array('name' => $name),array('name' => 'ASC'),1 ,0);               
        $kundenTemplate = null;
        $res = array ();
        if ($kunden){
            $kundenTemplateDefintion = $kundendefRep->findOneBy(array('kunden' =>$kunden),array('kunden' => 'ASC'),1 ,0);
  
            if ($kundenTemplateDefintion){
                $allArtikelQuery = "SELECT
                                    artikel.artikel_id, 
                                    artikel.artikel_name as name ,
                                    kategorie.kategorie_name as kategorie ,
                                    kollektion.kollektion_name as kollektion ,
                                    farbe.farbe_name, images.image_path 
                                    FROM artikel 
                                    INNER JOIN kategorie ON kategorie.kategorie_id = artikel.kategorie_id 
                                    INNER JOIN farbe ON artikel.farbe_id = farbe.farbe_id 
                                    INNER JOIN kollektion ON artikel.kollektion_id = kollektion.kollektion_id 
                                    INNER JOIN images ON images.image_id = artikel.image_id";
                $conn = $doctrine->getConnection();
                $stmt = $conn->prepare($allArtikelQuery);
                $resultSet = $stmt->executeQuery();
                $arikels_res =  $resultSet->fetchAllAssociative();
                
                
                $kundenTemplate = json_decode($kundenTemplateDefintion->getTemplate());
                $header = array_keys($arikels_res[0]);
                foreach($kundenTemplate as $key =>$value){ 
                    array_push($header,$key);
                }
                array_push($res,$header);
                foreach($arikels_res as $artikel){
                    $artikelId = $artikel['artikel_id'];
                    $line= array ();
                    array_push($line,$artikel['artikel_id']);
                    array_push($line,$artikel['name']);
                    array_push($line,$artikel['kategorie']);
                    array_push($line,$artikel['kollektion']);
                    array_push($line,$artikel['farbe_name']);
                    array_push($line,$artikel['image_path']);

                   if ($artikelId ){
                    foreach($kundenTemplate as $key => $value){
                        $inhaltDefintion = $this->getDefintionInhaltWithArtikelID($doctrine,$artikelId,$value);
                        array_push($line,$inhaltDefintion); 
                       
                    }
                    array_push($res,$line);
                   }  
                }
                                    
            }
        }
        

        $fp = fopen('C:\Users\omar2\Documents\TestoutputFile\file.csv', 'w');
        foreach ($res as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
      
        return $this->json(['message' => 'csv file was created successfully'],200);
    }
    public function getProductInfoWithCustomViewByName(
        KundenRepository $kundenrepo,
        KundenDefintionenRepository $kundendefRep,
        ArtikelRepository $artRep,
        ArtikelDefintionenRepository $artikelDefintionRepo,
        ManagerRegistry $doctrine,
        $name
        ):JsonResponse{
           
        $kunden = $kundenrepo->findOneBy(array('name' => $name),array('name' => 'ASC'),1 ,0);               
        $kundenTemplate = null;
        $res = array ();
        if ($kunden){
        $kundenTemplateDefintion = $kundendefRep->findOneBy(array('kunden' =>$kunden),array('kunden' => 'ASC'),1 ,0);
        $list = array();
        if ($kundenTemplateDefintion){
            $allArtikelQuery = "SELECT
                                artikel.artikel_id, 
                                artikel.artikel_name as name ,
                                kategorie.kategorie_name as kategorie ,
                                kollektion.kollektion_name as kollektion ,
                                farbe.farbe_name, images.image_path 
                                FROM artikel 
                                INNER JOIN kategorie ON kategorie.kategorie_id = artikel.kategorie_id 
                                INNER JOIN farbe ON artikel.farbe_id = farbe.farbe_id 
                                INNER JOIN kollektion ON artikel.kollektion_id = kollektion.kollektion_id 
                                INNER JOIN images ON images.image_id = artikel.image_id";
            $conn = $doctrine->getConnection();
            $stmt = $conn->prepare($allArtikelQuery);
            $resultSet = $stmt->executeQuery();
            $arikels_res =  $resultSet->fetchAllAssociative();
            $kundenTemplate = json_decode($kundenTemplateDefintion->getTemplate());

            $header = array_keys($arikels_res[0]);

            foreach($kundenTemplate as $key =>$value){ 
                array_push($header,$key);
            }
            array_push($res,$header);
            foreach($arikels_res as $artikel){
                $artikelId = $artikel['artikel_id'];
                $line= array ();
                array_push($line,$artikel['artikel_id']);
                array_push($line,$artikel['name']);
                array_push($line,$artikel['kategorie']);
                array_push($line,$artikel['kollektion']);
                array_push($line,$artikel['farbe_name']);
                array_push($line,$artikel['image_path']);

                if ($artikelId ){
                    foreach($kundenTemplate as $key => $value){
                        $inhaltDefintion = $this->getDefintionInhaltWithArtikelID($doctrine,$artikelId,$value);
                        array_push($line,$inhaltDefintion); 
                    }
                    array_push($res,$line);
                }  
            }
                        
        }
    }
    return $this->json($res,200);
}
    public function getDefintionInhaltWithArtikelID(ManagerRegistry $doctrine,$artikelId,$defId){
        $inhalt = "" ;
        $artikelId = intval($artikelId);
        $defId = intval($defId);
        if($artikelId && $defId ) {
            $conn = $doctrine->getConnection();
            $Arikel_def= "SELECT inhalt FROM artikel_defintionen WHERE artikel_id = ".$artikelId." and definition_id=".$defId." LIMIT 1";
            $stmt = $conn->prepare($Arikel_def);
            $resultSet = $stmt->executeQuery();
            
            $arikel_res =  $resultSet->fetchAllAssociative();
            if ($arikel_res){
                if (count ($arikel_res)>0){
                    $inhalt = $arikel_res[0]['inhalt'];
                }
            }        
            
        }
       return  $inhalt;
    }

}
