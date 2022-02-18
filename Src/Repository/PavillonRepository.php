<?php

namespace App\Repository;

use stdClass;
use App\Core\Orm\AbstractRepository;

class PavillonRepository extends AbstractRepository{
    

    public function __construct()
    {
        parent::__construct();
        $this->tableName="pavillon";
        $this->primaryKey="idPavillon";
    }
   
    
     function find(int $id):object{
        $sql="select * from $this->tableName where $this->primaryKey=?";
         return $this->dataBase->executeSelectObject($sql,[$id]);
      } 
      function findByPavillon():array{
        $sql="select * from $this->tableName where role like ? ";
        return $this->findBy($sql,[$this->role],false);
    }
    
}