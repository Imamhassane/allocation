<?php
namespace App\Entity;

class EtudiantBoursierLoge extends EtudiantBoursier{

    private Chambre $chambre;

    public static function  fromArray(object $etudiant):array{
        $arr =  array_values((array)$etudiant);
         $arr[]=$arr[4];
         $arr[]=$arr[5];
         $arr[]=$arr[6];
         $arr[]='';
         $arr[]='';
         $arr[]=$arr[1];
         $arr[]=$arr[2];
         $arr[]=$arr[0];
         $arr[]=NULL;
         $arr[]=$arr[3];
         unset($arr[0]);
         unset($arr[1]);       
         unset($arr[2]);
         unset($arr[3]);
         unset($arr[4]);
         unset($arr[5]);
         unset($arr[6]);
         return array_values($arr); 
     }
}