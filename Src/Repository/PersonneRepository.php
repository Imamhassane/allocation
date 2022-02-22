<?php
namespace App\Repository;
use App\Core\Orm\AbstractRepository;
use \stdClass;

class PersonneRepository extends AbstractRepository{
    public function __construct()
    {
        parent::__construct();
        $this->tableName="user";
        $this->primaryKey="idUser";
    }
   
  

      public function findPersonneByLoginAndPassword(string $login,string $password):object|bool{
        $sql="select * from $this->tableName where login=? and password=?";
           return $this->findBy($sql,[$login,$password],true);

      }
      public function loginExist(string $login):object|bool{
        $sql="select * from $this->tableName where login=? ";
           return $this->findBy($sql,[$login],true);
    }
   
}