<?php


namespace App\Controllers;

use App\Core\Role;
use App\Core\Request;
use App\Core\Session;
use App\Entity\Chambre;
use App\Core\AbstractController;
use App\Manager\EtudiantManager;
use App\Entity\EtudiantNonBoursier;
use App\Entity\EtudiantBoursierLoge;
use App\Repository\ChambreRepository;
use App\Repository\EtudiantRepository;
use App\Entity\EtudiantBoursierNonLoge;
use App\Manager\ChambreManager;

if(Role::isConnected()){
    class EtudiantController extends AbstractController{
        
        public function __construct()
        {
            parent::__construct();
            $this->cham         =   new ChambreRepository;
            $this->request      =   new Request ;
            $this->etudiant     =   new EtudiantRepository;
            $this->chamRepo     =   new ChambreRepository;
            $this->main         =   new EtudiantManager;
            $this->etudiantNB   =   new EtudiantNonBoursier;
            $this->EtudiantBNL  =   new EtudiantBoursierNonLoge;
            $this->EtudiantBL   =   new EtudiantBoursierLoge;
            $this->chamMan      =   new ChambreManager;
            $this->chambre      =   new chambre;
        }

        public  function ajoutEtudiant(){
            $chambres = $this->cham->findChambrePavillonNotNull();
            $this->render("etudiant/ajout.etudiant.html.php",["chambres"=>$chambres]);
        }

        public  function listeEtudiant(){
            $post=$this->request->request();
            extract($post);
            $url            = $this->request->getUrl();
            $chambres       = $this->chamRepo->findChambreDispo();
            
            $get=$this->request->query();

            $pages = $get[0][5];
            if (isset($pages)){    
                $page  = $pages; 
            }    
            else {    
                $page=1;    
            } 

            if(isset($ok)){
               if($chambre=="" && $bourse !=""){
                $etuloges  =   $this->etudiant->findPersonneByBourse($bourse);
               }elseif($bourse=="" && $chambre!=""){
                $etuloges   =   $this->etudiant->findEtudiantByChambre((int)$chambre);
               }elseif($chambre=="" && $bourse ==""){
                $etuloges   =   $this->etudiant->findEtudiantloge($page);
                $etudiants  =   $this->etudiant->findPersonneByRole($page);  
               }
            }else{                                                            
                $etuloges   =   $this->etudiant->findEtudiantloge($page);
                $etudiants  =   $this->etudiant->findPersonneByRole($page);   
            }
            $per_page_record    = per_page_record;
            $total_records      = Session::getSession("total_records");

            $this->render("etudiant/liste.etudiant.html.php",["chambres"=>$chambres,"etudiants"=>$etudiants,"etuloges"=>$etuloges,"url"=>$url,"per_page_record"=>$per_page_record,"total_records"=>$total_records,"pages"=>$pages,"post"=>$post]);
            Session::removeKey("sql2");

        } 
        
        public  function addEtudiant(){
            $arrErr=[];
            if($this->request->isPost()){
                extract($this->request->request());
                $this->validator->isVide($nom,"nom");
                $this->validator->isVide($prenom,"prenom");
                $this->validator->logExist($login,"login");
                $this->validator->isVide($dateNaissance,"dateNaissance");
                $this->validator->validNum($telephone,"telephone");
                $this->validator->validSelect($typeEtudiant,"typeEtudiant");
                //var_dump($typeEtudiant);die;
                if($typeEtudiant=='nonBoursier'){
                    $this->validator->isVide($adresse,"adresse");
                }
                if($typeEtudiant=='boursierNL'){
                    $this->validator->validSelect($typebourse,"typebourse");
                }
                if($typeEtudiant=='boursierLoge'){
                    $this->validator->validSelect($typebourse,"typebourse");
                    $this->validator->validSelect($chambreEtu,"chambreEtu");
                }
                if($this->validator->valid()){
                    $mat=substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(3/strlen($x)) )),1,3).date_format(date_create(),'Y');
                    if($adresse !=''){
                        $etu = new EtudiantNonBoursier();
                        $this->etudiantNB->setNom($nom)
                                         ->setPrenom($prenom)
                                         ->setLogin($login)
                                         ->setAdresse($adresse)
                                         ->setMatricule($mat)
                                         ->setDateNaissnce($dateNaissance)
                                         ->setTelephone($telephone);
                        $insert=$this->etudiantNB->fromArray($this->etudiantNB);
                        $this->main->insert($insert);
                    }elseif($typebourse !='' && $chambreEtu =='select' && $adresse =='' ){
                        $this->EtudiantBNL->setNom($nom)
                                          ->setPrenom($prenom)
                                          ->setLogin($login)
                                          ->setMatricule($mat)
                                          ->setDateNaissnce($dateNaissance)
                                          ->setTelephone($telephone)
                                          ->setTypeBourse($typebourse);
                        $insert=$this->EtudiantBNL->fromArray($this->EtudiantBNL);
                        $this->main->insert($insert);
                    }elseif($type !='' && $chambreEtu !='' && $adresse ==''){
                        $etuloges= $this->etudiant->findEtudiantloge1();
                        $student=$this->cham->findById($chambreEtu);
                        $typeCham=$student[0]->typechambre;
                            foreach($etuloges as $etu){
                                if($etu->idchambre==$chambreEtu){
                                    $cpt++;
                                }
                            }
                        if ($typeCham=='individuel' || $typeCham=='duo' && $cpt == 1 ) {
                            $this->chambre->setOccupation('occupee')
                                          ->setIdChambre($chambreEtu);
                            $update=$this->chambre->fromArrayup($this->chambre);
                            $this->chamMan->updateOccupation($update);
                        }
                        $this->EtudiantBL->setNom($nom)
                                         ->setPrenom($prenom)
                                         ->setLogin($login)
                                         ->setMatricule($mat)
                                         ->setDateNaissnce($dateNaissance)
                                         ->setTelephone($telephone)
                                         ->setTypeBourse($type);
                        if($chambreEtu=='select'){
                            $this->EtudiantBL->setIdChambre(null);
                        }else{
                            $this->EtudiantBL->setIdChambre($chambreEtu);
                        }
                        $insert=$this->EtudiantBL->fromArray($this->EtudiantBL);
                        $this->main->insert($insert);
                    }
                    
                Session::setSession("message", 1);
                $this->redirect("etudiant/listeEtudiant");
                }else{
                    Session::setSession("errors",$this->validator->getErreurs());
                    $this->redirect("etudiant/ajoutEtudiant");
                    
                }
                
            } 
        }
    }         
    }else{
    $Notconnected= new SecurityController;
    $Notconnected->redirect("security");
}