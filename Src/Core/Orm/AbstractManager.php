<?php
namespace App\Core\Orm;


abstract class AbstractManager extends AbstractObject implements ManagerInterface{
   
    public function remove($id):int{
        $sql="delete from $this->tableName where $this->primaryKey=?";
        return $this->dataBase->executeUpdate($sql,[$id]);
    }
    function persit(array $model):int{
       if(isset($model[$this->primaryKey])){
           return $this->update($model);
       }else{
          return  $this->insert($model);
       }
    }
}