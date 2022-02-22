<?php


namespace App\Controllers;

use App\Core\Role;
use App\Core\Request;
use App\Core\Session;
use App\Entity\Pavillon;
use App\Core\AbstractController;
use App\Entity\Chambre;
use App\Manager\ChambreManager;
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
        public function getchambrepavillon(Request $request){
            $repository = new ChambreRepository;
            $url = $request->getUrl();
            $id=$request->query();
            $id=$id[0];
            if($url[0]=='pavillon'){
                $chambrepavillon=$repository->findPavillonByChambre($id);
            }
            $this->render("chambre/liste.chambre.html.php",["chambrepavillon"=>$chambrepavillon,"url"=>$url]);

        }
        public  function edit(Request $request){
            $id=$request->query();
            $id=$id[0];
            Session::setSession("idPav", $id);
            $restor=$this->PavRepo->findById($id);
            $this->render("pavillon/ajout.pavillon.html.php",["restor"=>$restor]);
        }
         public  function addPavillon(Request $request){
            $arrErr=[];
            if($request->isPost()){
            extract($request->request());
            $this->validator->isVide($numPavillon,"numPavillon");
            $this->validator->validNum($nbreEtage,"nbreEtage");
            if(isset($create)){
                $this->validator->isVide($numChambre,"numChambre");
                $this->validator->validNum($numEtage,"numEtage");
                $this->validator->validSelect($typeChambre,"typeChambre");
                         
            }
          //  $this->validator->validSelect($typeChambre,"typeChambre");
                if($this->validator->valid()){
                    $pavillons = new Pavillon();
                    $main=new PavillonManager();
                    $chambreEntity = new Chambre;
                    $chambreManager=new ChambreManager;
                    $pavillons->setNumPavillon($numPavillon);
                    $pavillons->setNbreEtage($nbreEtage);
                    if($id==null){
                        $insert=$pavillons->fromArray($pavillons);
                        $newPavillon=$main->insert($insert);
                        foreach($chambre as $chambres){
                            $myChambre=$this->chambres->findById($chambres);
                            $chambreEntity->setIdChambre($myChambre[0]->idchambre);
                            $chambreEntity->setNumChambre($myChambre[0]->numchambre);
                            $chambreEntity->setNumEtage($myChambre[0]->numetage);
                            $chambreEntity->setTypeChambre($myChambre[0]->typechambre);
                            $chambreEntity->setIdPavillon($newPavillon);
                            $chambreEntity->setEtat($myChambre[0]->etat);
                            $chamModif=$chambreEntity->fromArrayUpdate($chambreEntity);
                            $chambreManager->update($chamModif);
                        }
                        if(isset($create)){
                            $chambreEntity->setNumChambre($numChambre);
                            $chambreEntity->setNumEtage($numEtage);
                            $chambreEntity->setTypeChambre($typeChambre);
                            $chambreEntity->setIdPavillon($newPavillon);
                            $insert=$chambreEntity->fromArray($chambreEntity);
                             //var_dump($isert);
                           $chambreManager->insert($insert);                            
                        }
                    }else{
                        $pavillons->setIdPavillon($id);
                        $insert=$pavillons->fromArrayUpdate($pavillons);
                        $main->update($insert);
                    }
                    $this->redirect("pavillon/listePavillon");
                }else{
                    Session::setSession("errors",$this->validator->getErreurs());
                    if((int)$id != 0){
                       $this->redirect("pavillon/edit/".$id);
                    }elseif((int)$id==0){
                        $this->redirect("pavillon/ajoutPavillon");
                    }
                }
            
            } 
        } 

    }
}else{
    $Notconnected= new SecurityController;
    $Notconnected->redirect("security");
}