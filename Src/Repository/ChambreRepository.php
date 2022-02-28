<?php

namespace App\Repository;

use App\Core\Session;
use App\Core\Orm\AbstractRepository;

class ChambreRepository extends AbstractRepository{
    

    public function __construct()
    {
        parent::__construct();
        $this->tableName="chambre";
        $this->primaryKey="idChambre";
        $this->secondaryKey="idPavillon";
        $this->etat="non-archivee";
        $this->etat2="archivee";
        $this->tableName1="pavillon";
    }

    function getChambreByEtat():array{

        $sql="SELECT * from $this->tableName where etat like ? and $this->secondaryKey is null ";
        return $this->findBy($sql,[$this->etat],false);

    }

    function getChambreByEtatArchive():array{

        $sql="SELECT * from $this->tableName where etat like ? and $this->secondaryKey is null ";
        return $this->findBy($sql,[$this->etat2],false);

    }
    
    function FindChambreAndPavillonArchive():array{

        $sql="SELECT * FROM $this->tableName 
        INNER JOIN $this->tableName1 
            WHERE $this->tableName.$this->secondaryKey = $this->tableName1.$this->secondaryKey 
                and $this->tableName.etat like ?";


        return $this->findBy($sql,[$this->etat2],false);
    }


    function findChambreByEtat($page=null):array{
        $start_from = ($page-1) * per_page_record2;     

        $sql="SELECT * from $this->tableName where etat like ? and $this->secondaryKey is null LIMIT $start_from, ".per_page_record2;

        $sql2="SELECT * from $this->tableName where etat like ? and $this->secondaryKey is null ";
        Session::setSession("sql2",$sql2);

        return $this->findBy($sql,[$this->etat],false);
    }


    function FindChambreAndPavillon($page=null):array{
        $start_from = ($page-1) * per_page_record;     

        $sql="SELECT * FROM $this->tableName 
                INNER JOIN $this->tableName1 
                    WHERE $this->tableName.$this->secondaryKey = $this->tableName1.$this->secondaryKey 
                        and $this->tableName.etat like ? LIMIT $start_from, ".per_page_record;


        $sql2="SELECT * FROM $this->tableName 
        INNER JOIN $this->tableName1 
            WHERE $this->tableName.$this->secondaryKey = $this->tableName1.$this->secondaryKey 
                and $this->tableName.etat like ?";

        Session::setSession("sql2",$sql2);

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
        return $this->findBy($sql,[$id],false);
    }


   

   
    
}