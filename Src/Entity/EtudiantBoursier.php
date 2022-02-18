<?php
namespace App\Entity;

class EtudiantBoursier extends Etudiant{
    
    protected string $typeBourse ;

    /**
     * Get the value of typeBourse
     *
     * @return  string
     */
    public function getTypeBourse()
    {
        return $this->typeBourse;
    }

    /**
     * Set the value of typeBourse
     *
     * @param  string  $typeBourse
     *
     * @return  self
     */
    public function setTypeBourse(string $typeBourse)
    {
        $this->typeBourse = $typeBourse;

        return $this;
    }
}