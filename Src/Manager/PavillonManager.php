<?php

namespace App\Manager;
use App\Core\Orm\AbstractManager;

class PavillonManager extends AbstractManager{
    

    public function __construct()
    {
        parent::__construct();
        $this->tableName="pavillon";
        $this->primaryKey="idPavillon";
    }
   
    function insert(array $data):int{
        $sql="INSERT INTO `pavillon` (`numPavillon`, `nbreEtage`) 
                VALUES ( ?, ?);";
        return $this->dataBase->executeUpdate($sql,$data);
    }
    public function update($model):int{
        $sql="UPDATE $this->tableName 
            SET `numPavillon` = ?, `nbreEtage` = ?
             WHERE $this->primaryKey = ? ";
        return $this->dataBase->executeUpdate($sql,$model);
    }

    
    
}