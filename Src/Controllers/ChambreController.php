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

if(Role::isConnected()){
    class ChambreController extends AbstractController{
         
        public function __construct(){
                parent::__construct();
                $this->ChamRepo=new ChambreRepository; 
                $this->request= new Request ;
                $this->pavi= new PavillonRepository;
                $this->chamEtu=new EtudiantRepository;
                $this->main=new ChambreManager();
                $this->chambres = new Chambre();
                $this->pavillon= new Pavillon;

        }
  
        public  function listeChambre(){
            
            $post=$this->request->request();
            extract($post);
            $url=$this->request->getUrl();
            $get=$this->request->query();
            $pavillons=$this->pavi->getAll();
            $pages = $get[0][5];
            if (isset($pages)){    
                $page  = $pages; 
            }    
            else {    
                $page=1;    
            } 
            if(isset($ok) && $chambre != ''){
                $ChambreAndPavillon= $this->ChamRepo->findPavillonByChambre($chambre);
            }elseif($url[0]=='chambre'){
                $chambres=$this->ChamRepo->findChambreByEtat($page);
                $ChambreAndPavillon=$this->ChamRepo->FindChambreAndPavillon($page);
            }




            $per_page_record    = per_page_record;
            $total_records      = Session::getSession("total_records");

            
            $this->render("chambre/liste.chambre.html.php",["chambres"=>$chambres,"url"=>$url,"ChambreAndPavillon"=>$ChambreAndPavillon,"per_page_record"=>$per_page_record,"total_records"=>$total_records,"pages"=>$pages,"pavillons"=>$pavillons,"post"=>$post]);   
            Session::removeKey("sql2");
 
        } 

        public  function ChambreArchivee(){
            $url=$this->request->getUrl();

            if($url[1]=='ChambreArchivee'){
                $chambres=$this->ChamRepo->getChambreByEtatArchive();
                $ChambreAndPavillon=$this->ChamRepo->FindChambreAndPavillonArchive();
            }

            
            $this->render("chambre/liste.chambre.html.php",["chambres"=>$chambres,"url"=>$url,"ChambreAndPavillon"=>$ChambreAndPavillon]);   
 
        } 

        public function addChambre(){
            $pavillons = $this->pavi->getAll();
            $this->render("chambre/ajout.chambre.html.php",["pavillons"=>$pavillons]);
        }

        public function chambreEtudiant(){
            $url =  $this->request->getUrl();
            $id  =  $this->request->query();
            $id  =  $id[0];
            $getEtudiant= $this->chamEtu->findEtudiantByChambre($id);
            $this->render("etudiant/liste.etudiant.html.php",["url"=>$url,"getEtudiant"=>$getEtudiant]);
        }

        public function edit(){
            $id     = $this->request->query();
            $id     = $id[0];
            $restor = $this->ChamRepo->findById($id);
            if (!$restor[0]->idpavillon==null) {
                $restorPavillons=$this->pavi->findById($restor[0]->idpavillon);
            }
            $pavillons = $this->pavi->getAll();
            $this->render("chambre/ajout.chambre.html.php",["restor"=>$restor,"pavillons"=>$pavillons,"restorPavillons"=>$restorPavillons]);
        }

        public  function ajoutChambre(){
            if($this->request->isPost()){
                extract($this->request->request());
                $nbretage = $this->pavi->findById($idPavillon);
                $nbretage = $nbretage[0]->nbreetage;
                Session::setSession("numChambre",$numChambre);
                Session::setSession("numEtage",$numEtage);
                Session::setSession("typeChambre",$typeChambre);


                $this->validator->validNum($numChambre,"numChambre");
                $this->validator->validNum($numEtage,"numEtage");
                $this->validator->validSelect($typeChambre,"typeChambre");

                if($nbretage < $numEtage){
                    Session::setSession("message", 0);
                    if((int)$id != 0){
                        $this->redirect("chambre/edit/".$id);
                     }elseif((int)$id==0){
                         $this->redirect("chambre/addChambre");
                     }
                }
                if($this->validator->valid()){
                    $this->chambres->setNumChambre((int)$numChambre)
                                    ->setNumEtage((int)$numEtage)
                                    ->setTypeChambre($typeChambre);
                    if($idPavillon=='select'){
                        $this->chambres->setIdPavillon(null);
                    }else{
                        $this->pavillon->setIdPavillon($idPavillon);
                        $idPavillon=$this->pavillon->getIdPavillon();
                        $this->chambres->setIdPavillon($idPavillon);
                    }
                    if($id==null){
                        $insert=$this->chambres->fromArray($this->chambres);
                        $this->main->insert($insert);
                    }else{
                        $this->chambres->setEtat('non-archivee');
                        $this->chambres->setIdChambre($id);
                        $insert=$this->chambres->fromArrayUpdate($this->chambres);
                        $this->main->update($insert);
                    }
                    Session::setSession("message", 1);
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
            $url = $this->request->getUrl();
            $id     =   $this->request->query();
            $id     =   $id[0];
            $getChambre = $this->ChamRepo->findById($id);
            if($this->request->isGet()){
                $this->chambres->setIdChambre($getChambre[0]->idchambre)
                               ->setNumChambre($getChambre[0]->numchambre)
                               ->setNumEtage($getChambre[0]->numetage)
                               ->setTypeChambre($getChambre[0]->typechambre)
                               ->setIdPavillon($getChambre[0]->idpavillon);
                                if($getChambre[0]->etat=="non-archivee"){
                                    $this->chambres->setEtat('archivee');
                                }else{
                                    $this->chambres->setEtat('non-archivee');
                                }
                $chambres=$this->chambres->fromArrayUpdate($this->chambres);
                $this->main->update($chambres);
            }
            if($getChambre[0]->etat=="non-archivee"){
                $this->redirect("chambre/listeChambre");
            }else{
                $this->redirect("chambre/ChambreArchivee");
            }
        }
    }         
}else{
    $Notconnected= new SecurityController;
    $Notconnected->redirect("security");
}