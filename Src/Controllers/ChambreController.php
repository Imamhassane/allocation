<?php


namespace App\Controllers;

use App\Core\Role;
use App\Core\Request;
use App\Core\Session;
use App\Entity\Chambre;
use App\Manager\ChambreManager;
use App\Core\AbstractController;
use App\Entity\Pavillon;
use App\Repository\ChambreRepository;
use App\Repository\EtudiantRepository;
use App\Repository\PavillonRepository;

if(Role::isConnected()==true){
    class ChambreController extends AbstractController{
       // private ChambreRepository $ChamRepo;
         
        public function __construct(){
                parent::__construct();
                $this->ChamRepo=new ChambreRepository; 
                $this->request= new Request ;
                $this->pavi= new PavillonRepository;
                
        }

        public  function listeChambre(){
            $url=$this->request->getUrl();
            if($url[0]=='chambre'){
                $chambres=$this->ChamRepo->findChambreByEtat();
                $ChambreAndPavillon=$this->ChamRepo->FindChambreAndPavillon();
            }
            $this->render("chambre/liste.chambre.html.php",["chambres"=>$chambres,"url"=>$url,"ChambreAndPavillon"=>$ChambreAndPavillon]);    

        } 

        public function addChambre(){
            $pavillons = $this->pavi->findAll();
            $this->render("chambre/ajout.chambre.html.php",["pavillons"=>$pavillons]);
        }

        public function chambreEtudiant(Request $request){
            $chamEtu = new EtudiantRepository;
            $url = $request->getUrl();
            $id=$request->query();
            $id=$id[0];
            $getEtudiant= $chamEtu->findEtudiantByChambre($id);
            $this->render("etudiant/liste.etudiant.html.php",["url"=>$url,"getEtudiant"=>$getEtudiant]);

        }
      

        public function edit(){
            $id=$this->request->query();
            $id=$id[0];
            $restor=$this->ChamRepo->findById($id);

            if (!$restor[0]->idpavillon==null) {
                $restorPavillons=$this->pavi->findById($restor[0]->idpavillon);
            }
            $pavillons = $this->pavi->findAll();
            $this->render("chambre/ajout.chambre.html.php",["restor"=>$restor,"pavillons"=>$pavillons,"restorPavillons"=>$restorPavillons]);
        }


        public  function ajoutChambre(){
            $arrErr=[];
           
            if($this->request->isPost()){
                extract($this->request->request());
                $this->validator->validNum($numChambre,"numChambre");
                $this->validator->validNum($numEtage,"numEtage");
                $this->validator->validSelect($typeChambre,"typeChambre");
                if($this->validator->valid()){
                    $chambres = new Chambre();
                    $main=new ChambreManager();
                    $this->pavillon= new Pavillon;
                    $chambres->setNumChambre($numChambre);
                    $chambres->setNumEtage($numEtage);
                    $chambres->setTypeChambre($typeChambre);
                    if($idPavillon=='select'){
                        $chambres->setIdPavillon(null);
                    }else{
                        $pav=$this->pavillon->setIdPavillon($idPavillon);
                        $idPavillon=$this->pavillon->getIdPavillon();
                        $chambres->setIdPavillon($idPavillon);
                    }
                    if($id==null){
                        $insert=$chambres->fromArray($chambres);
                        $main->insert($insert);
                    }else{
                        $chambres->setEtat('non-archivee');
                        $chambres->setIdChambre($id);
                        $insert=$chambres->fromArrayUpdate($chambres);
                        $main->update($insert);
                    }
                    $this->redirect("chambre/listeChambre"); 
                }else{
                    Session::setSession("errors",$this->validator->getErreurs() );
                    if((int)$id != 0){
                        $this->redirect("chambre/edit/".$id);
                     }elseif((int)$id==0){
                         $this->redirect("chambre/addChambre");
                     }
                }
            
            }  
        }


       
        public function archive(){
            $main=new ChambreManager();
            $chambres = new Chambre();
            $id=$this->request->query();
            $id=$id[0];
            $getChambre = $this->ChamRepo->findById($id);
            if($this->request->isGet()){
                $chambres->setIdChambre($getChambre[0]->idchambre);
                $chambres->setNumChambre($getChambre[0]->numchambre);
                $chambres->setNumEtage($getChambre[0]->numetage);
                $chambres->setTypeChambre($getChambre[0]->typechambre);
                $chambres->setIdPavillon($getChambre[0]->idpavillon);
                $chambres->setEtat('archivee');
                $chambres=$chambres->fromArrayUpdate($chambres);
                $main->update($chambres);
              //  var_dump($chambres  );
            }
           $this->redirect("chambre/listeChambre");
        }
    }         
}else{
    $Notconnected= new SecurityController;
    $Notconnected->redirect("security");
}