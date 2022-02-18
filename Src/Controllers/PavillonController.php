<?php


namespace App\Controllers;

use App\Core\Role;
use App\Core\Request;
use App\Core\Session;
use App\Entity\Pavillon;
use App\Core\AbstractController;
use App\Manager\PavillonManager;
use App\Repository\ChambreRepository;
use App\Repository\PavillonRepository;
if(Role::isConnected()==true){
class PavillonController extends AbstractController{
        private PavillonRepository $PavRepo; 
        
        public function __construct()
        {
            parent::__construct();
            $this->PavRepo=new PavillonRepository; 
            $this->chambres=new ChambreRepository;
        }
        public  function listePavillon(){
            $pavillons=$this->PavRepo->findAll();
            $this->render("pavillon/liste.pavillon.html.php",["pavillons"=>$pavillons]);
        }
        public  function ajoutPavillon(){
            $chambres=$this->chambres->findByPavillonAndEtat();
            $this->render("pavillon/ajout.pavillon.html.php",["chambres"=>$chambres]);
        }
        public  function edit(Request $request){
            $id=$request->query();
            $id=$id[0];
            $restor=$this->PavRepo->findById($id);
            $this->render("pavillon/ajout.pavillon.html.php",["restor"=>$restor]);
        }
         public  function addPavillon(Request $request){
            $arrErr=[];
            if($request->isPost()){
            extract($request->request());
            $this->validator->isVide($numPavillon,"numPavillon");
            $this->validator->isVide($nbreEtage,"nbreEtage");
          //  $this->validator->validSelect($typeChambre,"typeChambre");
            var_dump($chambre);
                if($this->validator->valid()){
                    // $pavillons = new Pavillon();
                    // $main=new PavillonManager();
                    // $pavillons->setNumPavillon($numPavillon);
                    // $pavillons->setNbreEtage($nbreEtage);
                    // if($id==null){
                    //     $insert=$pavillons->fromArray($pavillons);
                    //     $main->insert($insert);
                    // }else{
                    //     $pavillons->setIdPavillon($id);
                    //     $insert=$pavillons->fromArrayUpdate($pavillons);
                    //     //var_dump($insert);
                    //     $main->update($insert);
                    // }
                    //$this->redirect("pavillon/listePavillon");
                }else{
                    Session::setSession("errors",$this->validator->getErreurs() );
                    $this->redirect("pavillon/ajoutPavillon");
                }
            
            } 
        } 

    }
}else{
    $Notconnected= new SecurityController;
    $Notconnected->redirect("security");
}