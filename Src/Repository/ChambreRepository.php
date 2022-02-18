<?php

namespace App\Repository;

use App\Core\Orm\AbstractRepository;

class ChambreRepository extends AbstractRepository{
    

    public function __construct()
    {
        parent::__construct();
        $this->tableName="chambre";
        $this->primaryKey="idChambre";
        $this->etat="non-archivee";
    }
   
    function findByPavillonAndEtat():array{
        $sql="SELECT * from $this->tableName where idPavillon is null and etat like ? ";
        return $this->findBy($sql,[$this->etat],false);
    }

    
    
}