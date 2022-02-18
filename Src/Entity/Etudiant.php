<?php

namespace App\Entity;

use App\Entity\EntityInterface;

class Etudiant extends User implements EntityInterface{

    protected string $matricule;
    protected int $telephone;
    protected string $dateNaissnce;

    public static function  fromArray(object $etudiant):array{
        return $arr =  array_values((array)$etudiant);
        
    }

    /**
     * Get the value of matricule
     *
     * @return  string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set the value of matricule
     *
     * @param  string  $matricule
     *
     * @return  self
     */
    public function setMatricule(string $matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get the value of telephone
     *
     * @return  int
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @param  int  $telephone
     *
     * @return  self
     */
    public function setTelephone(int $telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of dateNaissnce
     *
     * @return  string
     */
    public function getDateNaissnce()
    {
        return $this->dateNaissnce;
    }

    /**
     * Set the value of dateNaissnce
     *
     * @param  string  $dateNaissnce
     *
     * @return  self
     */
    public function setDateNaissnce(string $dateNaissnce)
    {
        $this->dateNaissnce = $dateNaissnce;

        return $this;
    }
}