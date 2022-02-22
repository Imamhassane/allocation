<?php
namespace App\Entity;

use App\Entity\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;

class Chambre implements EntityInterface{
    private int $idChambre;
    private int $numChambre;
    private int $numEtage;
    private string $typeChambre;
    private string $etat;
    private string $occupation;

    private int|null $idPavillon;
    private Pavillon $pavillon;
  private Etudiant $etudiants;
   //  public ArrayCollection $etudiants;

    public function __construct()
    {
        
    }
    public static function  fromArray(object $chambres):array{
       return $arr =  array_values((array)$chambres);
       /* $arr[]=$arr[1];
       $arr[]=$arr[0];

       unset($arr[0]);
       unset($arr[1]); */

        //array_values((array)$arr) ;
    }
    public static function  fromArrayup(object $chambres):array{
        $arr =  array_values((array)$chambres);
        $arr[]=$arr[1];
        $arr[]=$arr[0];
 
        unset($arr[0]);
        unset($arr[1]);
 
        return array_values((array)$arr) ;
     }
    public static function  fromArrayUpdate(object $chambres):array{
        $arr =  array_values((array)$chambres);
        $arr[]=$arr[1];
        $arr[]=$arr[2];
        $arr[]=$arr[3];
        $arr[]=$arr[4];
        $arr[]=$arr[5];
        $arr[]=$arr[0];
        /* $arr[]=$arr[1];
        $arr[]=$arr[0]; */
 
        unset($arr[0]);
        unset($arr[1]);
        unset($arr[2]);
        unset($arr[3]);
        unset($arr[4]);
        unset($arr[5]);

        return array_values((array)$arr) ;
       }
    /**
     * Get the value of numChambre
     *
     * @return  int
     */
    public function getNumChambre()
    {
        return $this->numChambre;
    }

    /**
     * Set the value of numChambre
     *
     * @param  int  $numChambre
     *
     * @return  self
     */
    public function setNumChambre(int $numChambre)
    {
        $this->numChambre = $numChambre;

        return $this;
    }

    /**
     * Get the value of numEtage
     *
     * @return  int
     */
    public function getNumEtage()
    {
        return $this->numEtage;
    }

    /**
     * Set the value of numEtage
     *
     * @param  int  $numEtage
     *
     * @return  self
     */
    public function setNumEtage(int $numEtage)
    {
        $this->numEtage = $numEtage;

        return $this;
    }

   



    /**
     * Get the value of typeChambre
     *
     * @return  string
     */
    public function getTypeChambre()
    {
        return $this->typeChambre;
    }

    /**
     * Set the value of typeChambre
     *
     * @param  string  $typeChambre
     *
     * @return  self
     */
    public function setTypeChambre(string $typeChambre)
    {
        $this->typeChambre = $typeChambre;

        return $this;
    }

    /**
     * Get the value of idChambre
     *
     * @return  int
     */
    public function getIdChambre()
    {
        return $this->idChambre;
    }

    /**
     * Set the value of idChambre
     *
     * @param  int  $idChambre
     *
     * @return  self
     */
    public function setIdChambre(int $idChambre)
    {
        $this->idChambre = $idChambre;

        return $this;
    }

    /**
     * Get the value of etat
     *
     * @return  string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set the value of etat
     *
     * @param  string  $etat
     *
     * @return  self
     */
    public function setEtat(string $etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get the value of pavillon
     *
     * @return  Pavillon
     */
    public function getPavillon()
    {
        return $this->pavillon;
    }

    /**
     * Set the value of pavillon
     *
     * @param  Pavillon  $pavillon
     *
     * @return  self
     */
    public function setPavillon(Pavillon $pavillon)
    {
        $this->pavillon = $pavillon;

        return $this;
    }

  

    /**
     * Get the value of idPavillon
     *
     * @return  int|null
     */
    public function getIdPavillon()
    {
        return $this->idPavillon;
    }

    /**
     * Set the value of idPavillon
     *
     * @param  int|null  $idPavillon
     *
     * @return  self
     */
    public function setIdPavillon($idPavillon)
    {
        $this->idPavillon = $idPavillon;

        return $this;
    }

    /**
     * Get the value of occupation
     *
     * @return  string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Set the value of occupation
     *
     * @param  string  $occupation
     *
     * @return  self
     */
    public function setOccupation(string $occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }
}