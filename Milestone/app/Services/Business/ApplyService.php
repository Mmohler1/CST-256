<?php
namespace App\Services\Business;


use App\Models\ApplyModel;
use App\Services\Data\ApplyDAO;
use Illuminate\Http\Request;

//Bussiness class that runs the functions from the DAO for the Job
class ApplyService
{
    
    //Add Application
    public function joinApply(ApplyModel $applyData)
    {
        $appServ = new ApplyDAO;
        
        return $appServ->addApply($applyData);
    }
    
    //Delete Application
    public function removeApply(ApplyModel $applyData)
    {
        $appServ = new ApplyDAO;
        
        return $appServ->deleteApply($applyData);
    }
    
    //Display all applicants in a job
    public function displayApply(int $jobId)
    {
        $appServ = new ApplyDAO;
        
        return $appServ->showApply($jobId);
    }
    
    //Remove all applications
    public function deleteAllApply(int $jobId)
    {
        $appServ = new ApplyDAO;
        
        return $appServ->deleteAllApply($jobId);
    }
    
    
    //Checks if user is in apply
    public function checkApply (int $jobId, int $userId)
    {
        $appServ = new ApplyDAO;
        
        $users = $appServ->showApply($jobId);
        
        
        for($x = 0; $x < count($users); $x++)
        {
            if($users[$x]->getId() == $userId)
            {
                return true;
            }
            
        }
        return false;
    }
}

