<?php
namespace App\Services\Business;


use App\Models\JobModel;
use App\Services\Data\JobDAO;
use Illuminate\Http\Request;

//Bussiness class that runs the functions from the DAO for the Job
class JobService
{
    
    public function addAJob(JobModel $jobData)
    {
        $jobDAO  = new JobDAO();
        
        return $jobDAO->addJob($jobData);
        
    }
    
    public function updateAJob(JobModel $jobData, string $compare)
    {
        $jobDAO  = new JobDAO();
        
        return $jobDAO->updateJob($jobData, $compare);
        
    }
    
    public function deleteAJob(int $userID, string $userName)
    {
        $jobDAO  = new JobDAO();
        
        return $jobDAO->deleteJob($userID, $userName);
        
    }
    
    //Returns array of job list matching userID
    public function viewAJob(int $userID)
    {
        $jobDAO  = new JobDAO();
        
        return $jobDAO->viewJob($userID);
        
        
    }
    
    //Validation Rules to be returned
    public function validateJob(Request $request)
    {
        //setup Data Validation Rules for Login Form
        $rules = [
            'name' => 'Required | Between: 4, 80',
            'requirement' => 'Required | Between: 5, 250',
            'summary' => 'Required | Between: 5, 1000',
        ];
        
        return $rules;
        
    }
}

