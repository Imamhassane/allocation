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
use App\Repository\ChambreRepository;
use App\Repository\EtudiantRepository;
use App\Repository\PersonneRepository;
use App\Entity\EtudiantBoursierNonLoge;
if(Role::isConnected()==true){
    class EtudiantController extends AbstractController{
        
        public function __construct()
        {
            parent::__construct();
            $this->etudiant=new EtudiantRepository; 
           // $main= new EtudiantManager();

            $this->main=new EtudiantManager; 
            $this->chambre=new Chambre; 

            
        }
        public  function ajoutEtudiantNB(Request $request){
            $url = $request->getUrl();
            $this->render("etudiant/ajout.etudiant.html.php",["url"=>$url]);
        }
        public  function ajoutEtudiantBL(Request $request){
            $url = $request->getUrl();
            $this->render("etudiant/ajout.etudiant.html.php",["url"=>$url]);
        }
        public  function ajoutEtudiantBNL(Request $request){
            $url = $request->getUrl();
            $this->render("etudiant/ajout.etudiant.html.php",["url"=>$url]);
        }
        public  function listeEtudiant(){
            $etudiants=$this->etudiant->findPersonneByRole();
             $this->render("etudiant/liste.etudiant.html.php",["etudiants"=>$etudiants]);
        } 
        
        public  function addEtudiant(Request $request){
            $arrErr=[];
            $url = $request->getUrl();
            if($request->isPost()){
            extract($request->request());
            $this->validator->isVide($nom,"nom");
            $this->validator->isVide($prenom,"prenom");
            $this->validator->logExist($login,"login");
            $this->validator->isVide($dateNaissance,"dateNaissance");
            $this->validator->isVide($telephone,"telephone");
            if(isset($_POST['adresse'])){
                $this->validator->isVide($adresse,"adresse");
            }elseif(isset($_POST['typebourse'])){
                $this->validator->validSelect($typebourse,"typebourse");
            }elseif(isset($_POST['chambreEtu'])){
                $this->validator->validSelect($chambreEtu,"chambreEtu");
            }
                if($this->validator->valid()){
                    if(isset($_POST['adresse'])){
                        $etu = new EtudiantNonBoursier();
                        $etu->setNom($nom);
                        $etu->setPrenom($prenom);
                        $etu->setLogin($login);
                        $etu->setAdresse($adresse);
                        $etu->setMatricule(uniqid());
                        $etu->setDateNaissnce($dateNaissance);
                        $etu->setTelephone($telephone);
                        $insert=$etu->fromArray($etu);
                        $this->main->insert($insert);
                    }elseif(isset($_POST['typebourse']) && !isset($_POST['chambreEtu'])){
                        $etu = new EtudiantBoursierNonLoge;
                        $etu->setNom($nom);
                        $etu->setPrenom($prenom);
                        $etu->setLogin($login);
                        $etu->setMatricule(uniqid());
                        $etu->setDateNaissnce($dateNaissance);
                        $etu->setTelephone($telephone);
                        $etu->setTypeBourse($typebourse);
                        $insert=$etu->fromArray($etu);
                        $this->main->insert($insert);
                    }elseif(isset($_POST['typebourse']) && isset($_POST['chambreEtu'])){
                        $etu = new EtudiantBoursierNonLoge;
                        $chambre=new
                        $etu->setNom($nom);
                        $etu->setPrenom($prenom);
                        $etu->setLogin($login);
                        $etu->setMatricule(uniqid());
                        $etu->setDateNaissnce($dateNaissance);
                        $etu->setTelephone($telephone);
                        $etu->setTypeBourse($typebourse);
                        $insert=$etu->fromArray($etu);
                        $this->main->insert($insert);
                    }
                $this->redirect("etudiant/listeEtudiant");
                }else{
                    Session::setSession("errors",$this->validator->getErreurs());
                    if(isset($_POST['adresse'])){
                        $this->redirect("etudiant/ajoutEtudiantNB");
                    }elseif(isset($_POST['chambreEtu'])){
                        $this->redirect("etudiant/ajoutEtudiantBL");
                    }else{
                        $this->redirect("etudiant/ajoutEtudiantBNL");
                    }
                }
                
            } 
        }
    }         
}else{
    $Notconnected= new SecurityController;
    $Notconnected->redirect("security");
}