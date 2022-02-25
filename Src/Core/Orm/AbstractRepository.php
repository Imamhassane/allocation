<?php 

 namespace App\Core\Orm;
 use App\Core\Session;


 class AbstractRepository extends AbstractObject implements RepositoryInterface{
    
      public function __construct()
      {
          parent::__construct();
      }
    
    function findAll($page=null):array{
        $start_from = ($page-1) * per_page_record;     
        $sql="select * from $this->tableName LIMIT $start_from, ".per_page_record;
        $sql2="select * from $this->tableName";
          Session::setSession("sql2",$sql2);
        return $this->dataBase->executeSelect( $sql);

    }
    function getAll():array{
      $sql=" select * from $this->tableName";
      return $this->dataBase->executeSelect( $sql);

  }
      function findById(int $id):array|object{
        $sql="select * from $this->tableName where $this->primaryKey=?";
         return $this->dataBase->executeSelect($sql,[$id]);
      }

      function findBy(string $sql,array $data,$single=false):array|object|bool{
        return $this->dataBase->executeSelect($sql,$data,$single);
      }
   
  


}