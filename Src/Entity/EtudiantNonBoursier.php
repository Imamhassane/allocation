<?php
namespace App\Entity;

class EtudiantNonBoursier extends Etudiant {

    private string $adresse;

    public static function  fromArray(object $etudiant):array{
        $arr =  array_values((array)$etudiant);
       
        $arr[]=$arr[0];
        $arr[]=$arr[1];
        $arr[]=$arr[2];
        $arr[]='';
        $arr[]=$arr[6];
        $arr[]=$arr[3];
        $arr[]=$arr[4];
         $arr[]='';
         $arr[]=null;
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
    /**
     * Get the value of adresse
     *
     * @return  string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @param  string  $adresse
     *
     * @return  self
     */
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }
}