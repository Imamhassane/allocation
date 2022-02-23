<?php
namespace App\Repository;
use App\Core\Orm\AbstractRepository;
use \stdClass;

class EtudiantRepository extends PersonneRepository{
    
    public function __construct()
    {
        parent::__construct();
        $this->tableName="user";
        $this->primaryKey="idUser";
        $this->role="ETUDIANT";
        $this->secondaryKey="idchambre";
    }

    function findPersonneByRole():array{
        $sql="select * from $this->tableName where role like ? and $this->secondaryKey is null  ";
        return $this->findBy($sql,[$this->role],false);
    }
    function findEtudiantloge():array{
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
 //   $sql="SELECT * FROM chambre JOIN user join pavillon WHERE role like ? ";

}