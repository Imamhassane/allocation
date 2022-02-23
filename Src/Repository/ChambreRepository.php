<?php

namespace App\Repository;

use App\Core\Orm\AbstractRepository;

class ChambreRepository extends AbstractRepository{
    

    public function __construct()
    {
        parent::__construct();
        $this->tableName="chambre";
        $this->primaryKey="idChambre";
        $this->secondaryKey="idPavillon";
        $this->etat="non-archivee";
        $this->tableName1="pavillon";
    }
   
    function findByPavillonAndEtat():array{
        $sql="SELECT * from $this->tableName where $this->secondaryKey is null and etat like ? ";
        return $this->findBy($sql,[$this->etat],false);
    }
    function findChambreByEtat():array{
        $sql="SELECT * from $this->tableName where etat like ? and $this->secondaryKey is null ";
        return $this->findBy($sql,[$this->etat],false);
    }
    function findChambrePavillonNotNull():array{
        $sql="SELECT * FROM $this->tableName 
                INNER JOIN $this->tableName1 
                    WHERE $this->tableName.$this->secondaryKey = $this->tableName1.$this->secondaryKey 
                        and $this->tableName.occupation like ?";
        return $this->dataBase->executeSelect($sql,['non-occupee']);
    }

    function findChambreDispo():array{
        $sql="SELECT * FROM $this->tableName 
                INNER JOIN $this->tableName1 
                    WHERE $this->tableName.$this->secondaryKey = $this->tableName1.$this->secondaryKey ";
        return $this->dataBase->executeSelect($sql);
    }

    function findPavillonByChambre(int $id):array|object{
        $sql="select * from $this->tableName where $this->secondaryKey=?";
         return $this->dataBase->executeSelect($sql,[$id]);
    }


    function FindChambreAndPavillon():array{
        $sql="SELECT * FROM $this->tableName 
                INNER JOIN $this->tableName1 
                    WHERE $this->tableName.$this->secondaryKey = $this->tableName1.$this->secondaryKey 
                        and $this->tableName.etat like ?";
        return $this->findBy($sql,[$this->etat],false);
    }

    /* function filterChambre():array{
        $sql="SELECT distinct numPavillon FROM $this->tableName 
                INNER JOIN $this->tableName1 
                    WHERE $this->tableName.$this->secondaryKey = $this->tableName1.$this->secondaryKey ";
        return $this->dataBase->executeSelect($sql);
    } */


    function findChambreByChambre(int $id):array|object{
        $sql="select * from $this->tableName where $this->secondaryKey = ?";
        return $this->dataBase->executeSelect($sql,[$id]);
    }
    
}