<?php 
 namespace App\Core\Orm;
 interface RepositoryInterface{
      function findAll():array;
      function findById(int $id):array|object;
      function findBy(string $sql,array $data,$single=false):array|object|bool;

 }