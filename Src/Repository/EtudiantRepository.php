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
    }

    function findPersonneByRole():array{
        $sql="select * from $this->tableName where role like ? ";
        return $this->findBy($sql,[$this->role],false);
    }
}