<?php 

  namespace App\Core;
  use App\Repository\PersonneRepository;

  class Validator{
      private  array $erreurs=[];

      public function __construct()
      {
          $this->log = new PersonneRepository;
      }

    public  function  logExist(string $field,string $key){
        if($this->log->loginExist($field)){
           $this->erreurs[$key] ="Ce login existe déjà";
        }elseif(empty($field)){
            $this->erreurs[$key] ="Ce Champ est Obligatoire";
         }
   }
      public  function  isVide(string $field,string $key){
           if(empty($field)){
              $this->erreurs[$key] ="Ce Champ est Obligatoire";
           }
      }
      public  function  validNum(string $field,string $key){
        if(empty($field)){
           $this->erreurs[$key] ="Ce Champ est Obligatoire";
        }elseif(!is_numeric($field)){
            $this->erreurs[$key] ="Ce Champ doit être numérique";
        }
   }
    public  function  validSelect(string $field,string $key){
        if(empty($field)){
            $this->erreurs[$key] ="Ce Champ est Obligatoire";
        }elseif($field=='select'){
            $this->erreurs[$key] ="Ce Champ est Obligatoire";
        }
    }
    
      /**
       * Get the value of erreurs
       */ 
      public function getErreurs()
      {
            return $this->erreurs;
      }

      public function valid():bool{
          return count($this->erreurs)==0;
      }
  }