<?php
namespace App\Entity;

use App\Entity\EntityInterface;

class Pavillon implements EntityInterface{

    private int $idPavillon;
    private string $numPavillon ;
    private int $nbreEtage;
    private Chambre $chambres;
    public static function  fromArray(object $pavillon):array{
        return $arr =  array_values((array)$pavillon);

    }
    public static function  fromArrayUpdate(object $chambres):array{
        $arr =  array_values((array)$chambres);
        $arr[]=$arr[1];
        $arr[]=$arr[2];
        $arr[]=$arr[0];
        unset($arr[0]);
        unset($arr[1]);
        unset($arr[2]);
        return array_values((array)$arr) ;
    }
    /**
     * Get the value of idPavillon
     *
     * @return  int
     */
    public function getIdPavillon()
    {
        return $this->idPavillon;
    }

    /**
     * Set the value of idPavillon
     *
     * @param  int  $idPavillon
     *
     * @return  self
     */
    public function setIdPavillon(int $idPavillon)
    {
        $this->idPavillon = $idPavillon;

        return $this;
    }

    /**
     * Get the value of numPavillon
     *
     * @return  string
     */
    public function getNumPavillon()
    {
        return $this->numPavillon;
    }

    /**
     * Set the value of numPavillon
     *
     * @param  string  $numPavillon
     *
     * @return  self
     */
    public function setNumPavillon(string $numPavillon)
    {
        $this->numPavillon = $numPavillon;

        return $this;
    }

    /**
     * Get the value of nbreEtage
     *
     * @return  int
     */
    public function getNbreEtage()
    {
        return $this->nbreEtage;
    }

    /**
     * Set the value of nbreEtage
     *
     * @param  int  $nbreEtage
     *
     * @return  self
     */
    public function setNbreEtage(int $nbreEtage)
    {
        $this->nbreEtage = $nbreEtage;

        return $this;
    }

    /**
     * Get the value of chambres
     *
     * @return  Chambre
     */
    public function getChambres()
    {
        return $this->chambres;
    }

    /**
     * Set the value of chambres
     *
     * @param  Chambre  $chambres
     *
     * @return  self
     */
    public function setChambres(Chambre $chambres)
    {
        $this->chambres = $chambres;

        return $this;
    }
}