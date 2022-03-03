<?php
namespace App\Entity;

class EtudiantBoursierNonLoge extends EtudiantBoursier{
    

    public static function  fromArray(object $etudiant):array{
       $arr =  array_values((array)$etudiant);
        $arr[]=$arr[0];
        $arr[]=$arr[1];
        $arr[]=$arr[2];
        $arr[]='';
        $arr[]='';
        $arr[]=$arr[3];
        $arr[]=$arr[4];
        $arr[]=$arr[6];
        $arr[]=NULL;
        $arr[]=$arr[5];
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