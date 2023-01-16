<?php
namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\FlowRepository;
use App\Repository\SftpRepository;
use App\Entity\Sftp;
use Doctrine\Persistence\ManagerRegistry;
use App\Controller\LogJobsController;
use phpseclib3\Net\SFTP\Stream;
use phpseclib3\Net\SFTP as sftpClient;
use Symfony\Component\HttpFoundation\RequestStack;

class SftpInSftpOutService
{
    private $info = "";
    private $error ="";
    private $logjobs;
    private $flowRepo;
    private $sftpRepo;
    private $doctrine;
    protected $requestStack;
    
    public function __construct(FlowRepository $flowRepo,SftpRepository $sftpRepo,ManagerRegistry $doctrine,LogJobsController $logjobs){
        $this->logjobs=$logjobs;
        $this->flowRepo=  $flowRepo;
        $this->sftpRepo=  $sftpRepo;
        $this->doctrine=  $doctrine;
        

    }
    public  function createFileByFlowId($id):Array
    {
        set_time_limit(0);
        $flow = null;
        $fileToSftp = null;
        $resFromSftp =null;
        if ($id){
            $id = intval($id);
            if ($id>0){
                $flow = $this->flowRepo->findOneBy(array('id' => $id));
                date_default_timezone_set("Europe/Berlin");
                $flow->setLastRunTime(new \DateTime('now'));

                // wenn das Porzess mit OK beendet ist dann kann wieder gestatet werden 
                if ($flow->getLastRunLog()=="OK"){

                    $this->info = "Job ist gestartet !.<br>";
                    $sftpin = $this->sftpRepo->findOneBy(array('id' => $flow->getSftpInputServerId()));
                    $sftpOut = $this->sftpRepo->findOneBy(array('id' => $flow->getSftpOutputServerId()));
                    $dateiNameIn = $flow->getInputDateiName();
                    $dateiNameOut = $flow->getOutputDateiName();
                    $mappe = trim($flow->getFlowMappe());
                    $mappeAsArray = explode(';',$mappe);
                    $clientHeader = array();
                    $headerToChange = array();

                    foreach($mappeAsArray as $mappe){
                        $array = explode('as',strtolower($mappe));

                        if (count($array)>=2){
                            if(trim($array[0])!=""){
                                $clientHeader[]=trim($array[0]);
                            }
                            if(trim($array[1])!=""){
                                $headerToChange[]=trim($array[1]);
                            }
                        }
                    }
                    if (is_object($sftpin)){

                        $this->info .= "es Wird versucht auf dem Eingang SFTP server einzubinden !.<br>";
                        $resFromSftp = $this->importFileFromSftpAsArray($sftpin,$dateiNameIn,$clientHeader);

                        if ($resFromSftp){
                            $this->info .= "es Wird versucht auf dem Ausgang SFTP server einzubinden !.<br>";
                            $this->createCsvFromsendToSftp($sftpOut,$dateiNameOut,$resFromSftp,$headerToChange);
                        }

                        $this->info .= " Job ist beendet !.<br>";

                        if (trim($this->error)==""){

                            $flow->setLastRunLog("OK");
                            $this->logjobs->LogIntoDatabase($this->info,$flow,$this->doctrine,"OK");

                        }else{

                            $flow->setLastRunLog("ERROR");
                            $this->logjobs->LogIntoDatabase($this->error,$flow,$doctrine,"ERROR");

                        }
                    }
                }
            }
        }
        return ["success"];
    }
    public function createCsvFromsendToSftp(Sftp $sftpout ,$OutDateiName ,&$dataAsArray,$headerToChange)
    {
       
        if ($sftpout){

            $password = $sftpout->getServerPassword();

            try{
                $sftpClient = new sftpClient($sftpout->getServer(),$sftpout->getSeverPort());
                $sftp_connect = $sftpClient->login($sftpout->getServerUserName(), $password);
                if (!$sftp_connect){
                    $this->error .= "Einloggen auf dem Output Sever hat nicht geklappt!<br>Bitte Anmeldedaten prüfen!<br>";
                }else{
                    $this->info .= "Verbindung zu Output Sftp Erfolgreich.<br>";
                    Stream::register();
                    $fp = fopen('sftp://'.$sftpout->getServerUserName().':'.$password.'@'.$sftpout->getServer().':'.$sftpout->getSeverPort().$OutDateiName, 'w');
                    $dataHeaderOrgin = $dataAsArray[0];
                    if (count($dataHeaderOrgin) == count($headerToChange)){
                        $dataAsArray[0] = $headerToChange;
                    }else{
                        $this->error.="für jede Zeile der mape ist das wort 'as' wichtig.<br>";
                    }
                    foreach ($dataAsArray as $fields) {
                        fputcsv($fp, $fields);
                    }
                    fclose($fp);
                    $this->info.= "Ausgangsordner : '".$OutDateiName."'.<br>";
                    $this->info.= "Datei wurde erfolgreich erstellt und auf dem Output Server abgelegt.<br>";

                }
                unset($sftpClient);
            }catch(\Exception $e){
                $this->error .= $e->getMessage()."<br>";
            }
            $this->info .= "Die Verbindung zum Output Server wurde erfolgreich abgeschlossen.<br>";
        }
    }
    public function importFileFromSftpAsArray(Sftp $sftpIn ,$inputDateiName,$mappeHeader){

        $output = [];
        if ($sftpIn){
            try{
                $password = $sftpIn->getServerPassword();
                $sftpClient = new sftpClient($sftpIn->getServer(),$sftpIn->getSeverPort());
                $sftp_connect = $sftpClient->login($sftpIn->getServerUserName(), $password);
                if (!$sftp_connect) {
                    $this->error .= "Einloggen auf dem Einput Sever hat nicht geklappt!<br>Bitte Anmeldedaten prüfen!<br>";
                
                }else{
                    //If you want to download multiple data, use
                    //$x = $sftp->nlist();
    
                    $this->info .= "Verbindung zu Input Sftp Erfolgreich<br>";
    
                    if ($sftpClient->file_exists($inputDateiName)){
    
                        $result = $sftpClient->get($inputDateiName);
                        //res split
                        $lines = explode("\n", trim($result));
                        //get Header
                        $headOrigin = str_getcsv(array_shift($lines));
                        $colSpec = $this->getCustomPostionen($mappeHeader,$headOrigin);
    
                        $i = 0;
                        array_push($output,$mappeHeader);
                        foreach ($lines as $line) {
                            $i++;
                            $currOutput =array();
                            $l = str_getcsv($line);
                            foreach($colSpec as $currColumnIndex)
                            {
                                $currOutput[] = $l[$currColumnIndex];
                            }
                            if (count($mappeHeader) == count($currOutput)){
                                array_push($output,$currOutput);
                            }else{
                                $this->error .= 'Eingagnsdatei ist an line "'.$i.'" beschädigt <br>';   
                            }
                        }
                        $this->info.= "Eingangsordner : '".$inputDateiName."'.<br>";
                        $this->info .= "Datei wurde erfolgreich gelesen.<br>";
                    }else{
                        $this->error .= "Eingagnsdatei existiert nicht auf dem Server <br>";
                    }
                }
                unset($sftpClient);
            }catch(\Exception  $e){
                $this->error .= $e->getMessage()."<br>";
            }
            $this->info .= "Die Verbindung zum Input Server wurde erfolgreich abgeschlossen.<br>";                
        }
        return $output;
    }

    public function getCustomPostionen (&$mappeHeader,$headOrigin){
        
        try{
            $customPostionen = array();
            foreach($mappeHeader as &$mappe){
            
                $pos = array_search(strtolower($mappe),array_map('strtolower', $headOrigin));
            
                if ($pos>=0){
                    $customPostionen[] =  $pos;
                }
                if ($pos === false)
                {
                    $this->error .="Das Feld :'".$mappe."' existiert nicht in ursprügnliche Datei Bitte die Mappe anpassen.<br>";
                    unset($mappe);
                }
            }
        }catch(\Exception  $e){
            $this->error .= $e->getMessage()."<br>";
        }
        return  $customPostionen;
    }
}
