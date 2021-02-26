<?php
namespace App\Models;

class AnimalModel
{
    //Values
    private $bird;
    private $fish;
    private $sAnimal;
    private $lAnimal;
    
    
    //Constructor
    public function __construct($bird, $fish, $sAnimal, $lAnimal)
    {
        $this->bird = $bird;
        $this->fish = $fish;
        $this->sAnimal = $sAnimal;
        $this->lAnimal = $lAnimal;
        
        
    }
     
   
    
    //get setters
    /**
     * @return mixed
     */
    public function getBird()
    {
        return $this->bird;
    }

    /**
     * @return mixed
     */
    public function getFish()
    {
        return $this->fish;
    }

    /**
     * @return mixed
     */
    public function getSAnimal()
    {
        return $this->sAnimal;
    }

    /**
     * @return mixed
     */
    public function getLAnimal()
    {
        return $this->lAnimal;
    }

    /**
     * @param mixed $bird
     */
    public function setBird($bird)
    {
        $this->bird = $bird;
    }

    /**
     * @param mixed $fish
     */
    public function setFish($fish)
    {
        $this->fish = $fish;
    }

    /**
     * @param mixed $sAnimal
     */
    public function setSAnimal($sAnimal)
    {
        $this->sAnimal = $sAnimal;
    }

    /**
     * @param mixed $lAnimal
     */
    public function setLAnimal($lAnimal)
    {
        $this->lAnimal = $lAnimal;
    }

    


  
}


