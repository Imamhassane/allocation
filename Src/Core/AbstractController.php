<?php
namespace App\Core;

abstract class AbstractController implements ControllerInterface{
    protected string $layout="layout.base";
    protected Validator $validator;
    function __construct()
    {
           Session::start();
           $this->validator=new Validator;
    }
    function  render(string $views,array $data=[]):void{
        extract($data);
        //Recuperer le contenu des vues dans la variable $content_for_views
        ob_start();
        require_once(PATH_VIEWS."".$views);
        $content_for_views=ob_get_clean();
        require_once(PATH_VIEWS."".$this->layout.".html.php");
    }
    //Url controller/action/parametre1/parametre2
    function  redirect(string $url):void{
        header("location:".WEBROOT."".$url);
        exit();
    }
}