<?php

namespace App\Repository;

use stdClass;
use App\Core\Orm\AbstractRepository;

class PavillonRepository extends AbstractRepository{
    

    public function __construct()
    {
        parent::__construct();
        $this->tableName="pavillon";
        $this->primaryKey="idPavillon";

    }
   
    
    
    

    

}