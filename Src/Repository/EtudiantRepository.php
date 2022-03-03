<?php
namespace App\Repository;
use App\Core\Session;
use \stdClass;
use App\Core\Orm\AbstractRepository;

class EtudiantRepository extends PersonneRepository{
    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="user";
        $this->primaryKey="idUser";
        $this->role="ETUDIANT";
        $this->secondaryKey="idchambre";
    }

    function findPersonneByRole($page=null):array{
        $start_from = ($page-1) * per_page_record;     

        $sql="SELECT * from $this->tableName where $this->secondaryKey is null and role like ?   LIMIT $start_from, ".per_page_record;
        $sql2="SELECT * from $this->tableName where role like ? and $this->secondaryKey is null";
        Session::setSession("sql2",$sql2);

        return $this->findBy($sql,[$this->role],false);
    }


    function findEtudiantloge($page=null):array{
        $start_from = ($page-1) * per_page_record;     

        $sql="SELECT * FROM $this->tableName u 
                INNER JOIN chambre c on u.idChambre = c.idChambre 
                    INNER JOIN pavillon p on c.idPavillon = p.idPavillon LIMIT $start_from, ".per_page_record;
        
        $sql2="SELECT * FROM $this->tableName u 
                INNER JOIN chambre c on u.idChambre = c.idChambre 
                    INNER JOIN pavillon p on c.idPavillon = p.idPavillon";

        Session::setSession("sql2",$sql2);

        return $this->dataBase->executeSelect($sql);
    }

    function findEtudiantloge1():array{

        $sql="SELECT * FROM $this->tableName u 
                INNER JOIN chambre c on u.idChambre = c.idChambre 
                    INNER JOIN pavillon p on c.idPavillon = p.idPavillon";
       

        return $this->dataBase->executeSelect($sql);
    }



    function findEtudiantByChambre(int $id):array|object{
        $sql="SELECT * FROM $this->tableName u 
                    where $this->secondaryKey= ? ";
         return $this->dataBase->executeSelect($sql,[$id]);
    }



    function findPersonneByBourse($bourse):array{

        $sql="SELECT * from $this->tableName where typeBourse like ? ";
        return $this->findBy($sql,[$bourse],false);
    }

}