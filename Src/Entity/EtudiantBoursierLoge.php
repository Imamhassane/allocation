<?php
namespace App\Entity;

class EtudiantBoursierLoge extends EtudiantBoursier{

    private Chambre $chambre;
    private int|null $idChambre;

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
        $arr[]=$arr[7];
        $arr[]=$arr[5];

         unset($arr[0]);
         unset($arr[1]);       
         unset($arr[2]);
         unset($arr[3]);
         unset($arr[4]);
         unset($arr[5]);
         unset($arr[6]); 
         unset($arr[7]); 

         return array_values($arr); 
     }

    /**
     * Get the value of chambre
     *
     * @return  Chambre
     */
    public function getChambre()
    {
        return $this->chambre;
    }

    /**
     * Set the value of chambre
     *
     * @param  Chambre  $chambre
     *
     * @return  self
     */
    public function setChambre(Chambre $chambre)
    {
        $this->chambre = $chambre;

        return $this;
    }

    /**
     * Get the value of idChambre
     *
     * @return  int|null
     */
    public function getIdChambre()
    {
        return $this->idChambre;
    }

    /**
     * Set the value of idChambre
     *
     * @param  int|null  $idChambre
     *
     * @return  self
     */
    public function setIdChambre($idChambre)
    {
        $this->idChambre = $idChambre;

        return $this;
    }
}