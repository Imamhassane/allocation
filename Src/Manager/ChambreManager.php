<?php

namespace App\Manager;
use App\Core\Orm\AbstractManager;

class ChambreManager extends AbstractManager{
    

    public function __construct()
    {
        parent::__construct();
        $this->tableName="chambre";
        $this->primaryKey="idChambre";
    }
   
    function insert($data):int{
        $sql="INSERT INTO  $this->tableName  ( `numChambre`, `numEtage`, `typeChambre`, `idPavillon`) 
                VALUES ( ?, ?, ?,?)";
        return $this->dataBase->executeUpdate($sql,$data);
    }

    public function update($model):int{
        $sql="UPDATE  $this->tableName
                SET `numChambre` = ?, `numEtage` = ? , `typeChambre` = ? , `etat` = ? ,`idPavillon` = ?
                    WHERE $this->primaryKey = ? ";
        return $this->dataBase->executeUpdate($sql,$model);
    }
 
}