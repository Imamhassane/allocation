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
if(Role::isConnected()){
    class PavillonController extends AbstractController{
        private PavillonRepository $PavRepo; 
        
        public function __construct()
        {
                    parent::__construct();
                    $this->PavRepo=new PavillonRepository; 
                    $this->chambres=new ChambreRepository;
                    $this->request = new Request;
                    $this->pavillons = new Pavillon();
                    $this->main=new PavillonManager();
                    $this->chambreEntity = new Chambre;
                    $this->chambreManager=new ChambreManager;
        }
        public  function listePavillon(){
            $get=$this->request->query();

            $pages = $get[0][5];
            if (isset($pages)){    
                $page  = $pages; 
            }    
            else {    
                $page=1;    
            } 
            $pavillons=$this->PavRepo->findAll($page);

            $per_page_record    = per_page_record;
            $total_records      = Session::getSession("total_records");


            $this->render("pavillon/liste.pavillon.html.php",["pavillons"=>$pavillons,"per_page_record"=>$per_page_record,"total_records"=>$total_records,"pages"=>$pages]);
            Session::removeKey("sql2");

        }

        public  function ajoutPavillon(){
            $chambres=$this->chambres->getChambreByEtat();
            $this->render("pavillon/ajout.pavillon.html.php",["chambres"=>$chambres]);
        }

        public function getchambrepavillon(){
            $url = $this->request->getUrl();
            $id=$this->request->query();
            $id=$id[0];
            if($url[0]=='pavillon'){
                $chambrepavillon=$this->chambres->findPavillonByChambre($id);
            }
            $this->render("chambre/liste.chambre.html.php",["chambrepavillon"=>$chambrepavillon,"url"=>$url]);

        }

        public  function edit(){
            Session::setSession("url",$this->request->getUrl());
            $id=$this->request->query();
            $id=$id[0];
            $chambres=$this->chambres->getChambreByEtat();
            $chambreByPabillon = $this->chambres->getAll();
            foreach($chambreByPabillon as $chambrePav){
                if($chambrePav->idpavillon == $id){
                    $arrayChambre[]= $chambrePav;
                }
            }
            $restor=$this->PavRepo->findById($id);
            $this->render("pavillon/ajout.pavillon.html.php",["restor"=>$restor,"chambres"=>$chambres,"arrayChambre"=>$arrayChambre]);
        }

        public  function addPavillon(){
            $arrErr=[];
            if(Session::keyExist("url")){
                $url=Session::getSession("url");
            }
            if($this->request->isPost()){
              
                extract($this->request->request());
                
                Session::setSession("numPavillon",$numPavillon);
                Session::setSession("nbreEtage",$nbreEtage);

                $this->validator->isVide($numPavillon,"numPavillon");
                $this->validator->validNum($nbreEtage,"nbreEtage");
            
                if($chooseChambre=='add'){
                    $this->validator->isVide($numChambre,"numChambre");
                    $this->validator->validNum($numEtage,"numEtage");
                    $this->validator->validSelect($typeChambre,"typeChambre");
                }
                if($this->validator->valid()){
                    $this->pavillons->setNumPavillon($numPavillon)
                                    ->setNbreEtage($nbreEtage);
                    if($id==null){
                        $insert=$this->pavillons->fromArray($pavillons);
                        $newPavillon=$this->main->insert($insert);
                        if($chooseChambre=='affect'){
                            foreach($chambre as $chambres){
                                $myChambre=$this->chambres->findById((int)$chambres);
                                $this->chambreEntity->setIdChambre($myChambre[0]->idchambre)
                                                    ->setNumChambre($myChambre[0]->numchambre)
                                                    ->setNumEtage($myChambre[0]->numetage)
                                                    ->setTypeChambre($myChambre[0]->typechambre)
                                                    ->setIdPavillon((int)$newPavillon)
                                                    ->setEtat($myChambre[0]->etat);
                                $chamModif = $this->chambreEntity->fromArrayUpdate($this->chambreEntity);
                                $this->chambreManager->update($chamModif);
                            }
                        }
                        if($chooseChambre=='add'){
                            $this->chambreEntity->setNumChambre($numChambre)
                                                ->setNumEtage($numEtage)
                                                ->setTypeChambre($typeChambre)
                                                ->setIdPavillon($newPavillon);
                            $insert=$this->chambreEntity->fromArray($this->chambreEntity);
                            $this->chambreManager->insert($insert);                            
                        }
                    }else{
                        $this->pavillons->setIdPavillon($id);
                        $insert=$this->pavillons->fromArrayUpdate($this->pavillons);
                        $this->main->update($insert);
                        if($chooseChambre=='affect' ){
                            foreach($chambre as $chambres){
                                $myChambre=$this->chambres->findById((int)$chambres);
                                $this->chambreEntity->setIdChambre($myChambre[0]->idchambre)
                                                    ->setNumChambre($myChambre[0]->numchambre)
                                                    ->setNumEtage($myChambre[0]->numetage)
                                                    ->setTypeChambre($myChambre[0]->typechambre)
                                                    ->setIdPavillon((int)$id)
                                                    ->setEtat($myChambre[0]->etat);
                                $chamModif = $this->chambreEntity->fromArrayUpdate($this->chambreEntity);
                                $this->chambreManager->update($chamModif);
                            }
                        }
                        if($url[1]=='edit'){
                            $pavillonKey=$this->chambres->findPavillonByChambre($id);
                            foreach($pavillonKey as $key){
                                $myChambre=$this->chambres->findById($key->idchambre);
                                $this->chambreEntity->setIdChambre($myChambre[0]->idchambre)
                                                   ->setNumChambre($myChambre[0]->numchambre)
                                                   ->setNumEtage($myChambre[0]->numetage)
                                                   ->setTypeChambre($myChambre[0]->typechambre)
                                                   ->setIdPavillon(null)
                                                   ->setEtat($myChambre[0]->etat);
                              $chamModif = $this->chambreEntity->fromArrayUpdate($this->chambreEntity);
                              $this->chambreManager->update($chamModif);
                            }
                            foreach($chambre as $chambres){  
                                $myChambre=$this->chambres->findById((int)$chambres);
                                 $this->chambreEntity->setIdChambre($myChambre[0]->idchambre)
                                                    ->setNumChambre($myChambre[0]->numchambre)
                                                    ->setNumEtage($myChambre[0]->numetage)
                                                    ->setTypeChambre($myChambre[0]->typechambre)
                                                    ->setIdPavillon((int)$id)
                                                    ->setEtat($myChambre[0]->etat);
                                $chamModif = $this->chambreEntity->fromArrayUpdate($this->chambreEntity);
                                $this->chambreManager->update($chamModif);

                            }                                
                        }
                        if($chooseChambre=='add'){

                            $this->chambreEntity->setNumChambre($numChambre)
                                                ->setNumEtage($numEtage)
                                                ->setTypeChambre($typeChambre)
                                                ->setIdPavillon((int)$id);
                            $insert=$this->chambreEntity->fromArray($this->chambreEntity);
                            $this->chambreManager->insert($insert);
                        }
                    }
                    
                    $this->redirect("pavillon/listePavillon");
                    Session::removeKey("errors");

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