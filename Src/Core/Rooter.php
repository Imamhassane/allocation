<?php 
namespace App\Core;

use App\Controllers\ErreurController;

class Rooter{
    
    private Request $request;
    private ErreurController $erreurCtrl;

    public function __construct(Request $request)
    {
        $this->request=$request;
        $this->erreurCtrl=new ErreurController;
    }
    public function resolve(){
    //controller/action
       $url= $this->request->getUrl();
       $controllerClass= "App\Controllers\\";
       $controllerClass.=empty($url[0])?"SecurityController":ucfirst($url[0])."Controller";
       $controllerAction=empty($url[1])?"login":$url[1];
       if(class_exists($controllerClass)){
            $objController=new  $controllerClass;
            if(method_exists($objController, $controllerAction)) {
                call_user_func_array([$objController,$controllerAction],[$this->request]);
            } else{
                $this->erreurCtrl->redirect("erreur/pageNotFound") ;
            }
       }else{
          $this->erreurCtrl->redirect("erreur/pageNotFound") ;
       }
    }
}