<?php 
 namespace App\Core\Orm;
 interface ManagerInterface{
      function remove($id):int;
      //model ou entity => Personne,Etudiant,Classe
      function insert(array $model):int;
      function update(array $model):int;
      function persit(array $model):int;//insert et update
 }