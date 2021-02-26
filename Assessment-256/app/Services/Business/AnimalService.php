<?php
namespace App\Services\Business;


use App\Models\AnimalModel;


//Business clas
class AnimalService
{
    
    //Returns true or false based on string
    public function saveTheAnimals(AnimalModel $animalData)
    {
        
        //If any other data is CST-256 then return true.
        if ($animalData->getBird() == "CST-256")
        {
            return true;
        }
        elseif($animalData->getFish() == "CST-256")
        {
            return true;
        }
        elseif($animalData->getSAnimal() == "CST-256")
        {
            return true;
        }
        elseif($animalData->getLAnimal() == "CST-256")
        {
            
        }
        else 
        {
            //If not return false
            return false;
        }
        
        
    }
}

