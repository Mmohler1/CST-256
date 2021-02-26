<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnimalModel;
use App\Services\Business\AnimalService;


//Controller for the animal page
class AssessmentController extends Controller
{
    
    //shows the animal page
    public function index()
    {
     
        return view('assessment.blade.php');
    }
    
    
    //Saves Animal model from form submit
    public function saveAnimal(Request $request)
    {
        $animalData = new AnimalModel(request()->get('bird'), 
            request()->get('fish'), request()->get('sanimal'), request()->get('lanimal'));
        
        $secAnim = new AnimalService();
        $checkIf = $secAnim->saveTheAnimals($animalData);
        
        if($checkIf)
        {
            echo "CST-256 Was there";
        }
        else
        {
            echo "CST-256 Was Not there";
        }
        
        return view('assessment');
        
    }
    
}
