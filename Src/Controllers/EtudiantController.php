<?php


namespace App\Controllers;

use App\Core\Role;
use App\Core\Request;
use App\Core\Session;
use App\Entity\Chambre;
use App\Entity\Etudiant;
use App\Core\AbstractController;
use App\Manager\EtudiantManager;
use App\Entity\EtudiantNonBoursier;
use App\Entity\EtudiantBoursierLoge;
use App\Repository\ChambreRepository;
use App\Repository\EtudiantRepository;
use App\Repository\PersonneRepository;
use App\Entity\EtudiantBoursierNonLoge;
use App\Manager\ChambreManager;
use Doctrine\Common\Collections\ArrayCollection;

if(Role::isConnected()==true){
    class EtudiantController extends AbstractController{
        
        public function __construct()
        {
            parent::__construct();
        }

        public  function ajoutEtudiant(){
            $cham= new ChambreRepository;
            $chambres = $cham->findChambrePavillonNotNull();
            $this->render("etudiant/ajout.etudiant.html.php",["chambres"=>$chambres]);
        }

        public  function listeEtudiant(Request $request){
            $url = $request->getUrl();
            extract($request->request());

            $etudiant=new EtudiantRepository; 
            $chamRepo= new ChambreRepository;
            $chambres = $chamRepo->findChambreDispo();

            if(isset($ok)){
                 $etuloges= $etudiant->findEtudiantByChambre((int)$chambre);
            }else{                                                            
                $etuloges= $etudiant->findEtudiantloge();
               // $etudiants=$etudiant->findPersonneByRole();   
            }

            $this->render("etudiant/liste.etudiant.html.php",["chambres"=>$chambres,"etudiants"=>$etudiants,"etuloges"=>$etuloges,"url"=>$url]);
        } 
        
        public  function addEtudiant(Request $request){
            $arrErr=[];
            if($request->isPost()){
            extract($request->request());
                $this->validator->isVide($nom,"nom");
                $this->validator->isVide($prenom,"prenom");
                $this->validator->logExist($login,"login");
                $this->validator->isVide($dateNaissance,"dateNaissance");
                $this->validator->validNum($telephone,"telephone");
                if(isset($adresse)){
                    $this->validator->isVide($adresse,"adresse");
                }elseif(isset($typebourse)){
                    $this->validator->validSelect($typebourse,"typebourse");
                }
                if(isset($chambreEtu)){
                    $this->validator->validSelect($chambreEtu,"chambreEtu");
                }
                if($this->validator->valid()){
                    $main=new EtudiantManager;
                    if(isset($adresse)){
                        $etu = new EtudiantNonBoursier();
                        $etu->setNom($nom);
                        $etu->setPrenom($prenom);
                        $etu->setLogin($login);
                        $etu->setAdresse($adresse);
                            $mat=substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(3/strlen($x)) )),1,3).date_format(date_create(),'Y');
                        $etu->setMatricule($mat);
                        $etu->setDateNaissnce($dateNaissance);
                        $etu->setTelephone($telephone);
                        $insert=$etu->fromArray($etu);
                        $main->insert($insert);
                    }elseif(isset($typebourse) && !isset($chambreEtu)){
                        $etu = new EtudiantBoursierNonLoge;
                        $etu->setNom($nom);
                        $etu->setPrenom($prenom);
                        $etu->setLogin($login);
                            $mat=substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(3/strlen($x)) )),1,3).date_format(date_create(),'Y');
                        $etu->setMatricule($mat);
                        $etu->setDateNaissnce($dateNaissance);
                        $etu->setTelephone($telephone);
                        $etu->setTypeBourse($typebourse);
                        $insert=$etu->fromArray($etu);
                        $main->insert($insert);
                    }elseif(isset($typebourse) && isset($chambreEtu)){
                        $chamRepo= new ChambreRepository;
                        $etudiant=new EtudiantRepository; 
                        $chamMan=new ChambreManager;
                        $chambre= new chambre;
                        $etuloges= $etudiant->findEtudiantloge();
                        $student=$chamRepo->findById($chambreEtu);
                        $typeCham=$student[0]->typechambre;
                            foreach($etuloges as $etu){
                                if($etu->idchambre==$chambreEtu){
                                    $cpt++;
                                }
                            }
                        if ($typeCham=='individuel' || $typeCham=='duo' && $cpt == 1 ) {
                            $chambre->setOccupation('occupee');
                            $chambre->setIdChambre($chambreEtu);
                            $update=$chambre->fromArrayup($chambre);
                            $chamMan->updateOccupation($update);

                        }
                        $etu = new EtudiantBoursierLoge;
                        $etu->setNom($nom);
                        $etu->setPrenom($prenom);
                        $etu->setLogin($login);
                            $mat=substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(3/strlen($x)) )),1,3).date_format(date_create(),'Y');
                        $etu->setMatricule($mat);
                        $etu->setDateNaissnce($dateNaissance);
                        $etu->setTelephone($telephone);
                        $etu->setTypeBourse($typebourse);
                        if($chambreEtu=='select'){
                            $etu->setIdChambre(null);
                        }else{
                            $etu->setIdChambre($chambreEtu);
                        }
                        $insert=$etu->fromArray($etu);
                        $main->insert($insert);
                    }
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