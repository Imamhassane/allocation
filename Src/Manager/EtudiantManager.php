<?php

namespace App\Manager;
use App\Core\Orm\AbstractManager;

class EtudiantManager extends AbstractManager{
    

    public function __construct()
    {
        parent::__construct();
        $this->tableName="user";
        $this->primaryKey="idUser";
    }
   
    function insert(array $data):int{
        $sql="INSERT INTO  $this->tableName ( `nom`, `prenom`, `login`, `password`, `adresse`, `matricule`, `telephone`, `typeBourse`, `idChambre`, `dateNaissance`) 
                VALUES (?, ?, ?,?, ?, ?,?, ?, ?,?)";
        return $this->dataBase->executeUpdate($sql,$data);
    }
    public function update($model):int{
        return 0;
    }

    
    
}