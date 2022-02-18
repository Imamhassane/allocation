<?php 
  namespace App\Core;
  class Request{
  
    private function formatUrl():array{
         $url=explode('/',$_SERVER['REQUEST_URI']);
         unset($url[0]);
          return  array_values($url);
    }
   public function getUrl():array|string{
         //controller/action
       $url =$this->formatUrl();
       return [
               isset($url[0])?$url[0]:"",
               isset($url[1])?$url[1]:""
             ];
   }   
  public function   isPost():bool{
      return $_SERVER['REQUEST_METHOD']=="POST";
  }
  public function  isGet():bool{
      return $_SERVER['REQUEST_METHOD']=="GET";
  }
  public function  query():array{
      //Get => Parametre
      $url =$this->formatUrl();
      unset($url[0]);
      unset($url[1]);
      return array_values($url);
  }
  public function  request():array{
        return $_POST;
  }
    
  }