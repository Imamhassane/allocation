<?php 
 namespace App\Core\Orm;

use \PDO;
use stdClass;

class DataBase{

    //pdo=null=> connexion est fermee
     private PDO|null $pdo=null;
    //private int|float $x;

 
    private const   USER_BD = "imamHassane";
    private const   PASSWORD_BD = "alvinniass";
    private const   HOST_BD = "mysql:dbname=gestion_allocation;host=localhost";
    // private const   USER_BD = "258011_chambre";
    // private const   PASSWORD_BD = "alvinniass";
    // private const   HOST_BD = "mysql:dbname=allocationchambre_cours-poo-mvc;host=mysql-allocationchambre.alwaysdata.net";

  public function __construct()
  {
    $this->openConnexion();
  }
    
   private function openConnexion(){
    //Essayer
    try{
        
        if( $this->pdo==null){
            $this->pdo = new PDO(self::HOST_BD, self::USER_BD, self::PASSWORD_BD);
        }
        $this->pdo->setAttribute (PDO::ATTR_CASE ,PDO::CASE_LOWER) ;
        $this->pdo->setAttribute (PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION) ;
        $this->pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");  
      
  }catch (\PDOException $e){
        //Capturer
            die("Database connection failed: " . $e->getMessage());
    }
  }

public function executeSelect(string $sql,array $data=null,$single=false):array|stdClass|bool{
        // Requete non parametree 
            //select * from personne where id=$id
            //insert into personne(nom_complet,...,) values($nom_complet)
           //Execute requete select non parametre $pdo->query()
           //Execute requete Mis a jour non parametre  $pdo->exec()
          // Requete parametree
              //select * from personne where id=?
              //insert into personne(nom_complet,...,) values(?)
                 //Execute requete  parametre 
                   //1- Preparation de la requete ,$statement=$pdo->prepare()
                   //2- Execution  de la requete ,$statement->execute($data) 
                   //3-Recupecation des Resultats => Select 
                       //$statement->fetch() : un seul resultat
                       //$statement->fetchAll() : plusieurs resultats
                   // Exemple : 
                      //1-$statement=$pdo->prepare("select * from personne where id=? and nom_complet like ?")
                      //2-statement->execute([0=>1,1=>"wane"])//[0=>1,1=>"wane"] =>[1,"wane"]
                          //select * from personne where id=1 and nom_complet like wane

    $stm=$this->pdo->prepare($sql);

        if(is_null($data)){
           $stm->execute();
         
        }else{
          $stm->execute($data);
            //var_dump($stm);
        }
        return $single?$stm->fetch(\PDO::FETCH_OBJ):$stm->fetchAll(\PDO::FETCH_OBJ);
    }

  public function executeUpdate(string $sql,array $data):int{
    $stm=$this->pdo->prepare($sql);
    if(is_null($data)){
      $stm->execute();
    }else{
    // var_dump($stm);
        $stm->execute(array_values($data));
    }
    if(!strpos(strtolower($sql),strtolower("insert"))){
        return  $this->pdo->lastInsertId();
    }
      return  $stm->rowCount();
   }

private function fermerConexion(){
      $this->pdo=null;
}
    


public function executeSelectObject(string $sql,array $data=null):object{
  //
           

$stm=$this->pdo->prepare($sql);

  if(is_null($data)){
     $stm->execute();
   
  }else{
    $stm->execute($data);
  }
  return $stm->fetch(\PDO::FETCH_OBJ);
}

}