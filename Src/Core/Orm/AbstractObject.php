<?php 
 namespace App\Core\Orm;

class AbstractObject{
    protected string $tableName;
    protected string $primaryKey;
    //OneToOne
    protected DataBase $dataBase;

    public function __construct()
    {
        $this->dataBase=new DataBase();
    }

}