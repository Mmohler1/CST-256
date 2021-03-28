<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use App\Models\DTO;
use App\Services\Business\JobService;

//Makes a rest service for jobs
class JobsRestController extends Controller
{
    /**
     * Display a listing of every job up to 10
     *
     *URL is http://localhost/Milestone/jobsrest/
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Instantiate class
        $jobServ  = new JobService();
        $jobs = $jobServ->everyJob();
        $countJobs = count($jobs);
         
        
        //Print proper resposne and code for if obs are found or not found. Return list of jobs
        if ($jobs == null)
        {
            $dto = new DTO(404, "No Jobs found", $jobs);
            
        }
        else 
        {
            //If more then 10 then
            if ($countJobs > 10)
            {
                for($i = 0; $i < 10; $i++)
                {
                    $clipped[$i]=$jobs[$i];
                }
                $dto = new DTO(200, "Clipped", $clipped);
            }
            else
            {
                $dto = new DTO(200, "OK", $jobs);
            }
            
        }
        
        //set up json encoded variable
        $json = json_encode($dto);
        
        //Return in the json format
        return response($json)->header('Content-Type', 'application/json');
    }

  

    /**
     * Display the specified job 
     * URL is http://localhost/Milestone/jobsrest/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //Instantiate class
        $jobServ  = new JobService();
        $jobs = $jobServ->lookForJob($id);

        
        
        
        //Print proper resposne and code for if jobs are found or not found. Return list of jobs
        if ($jobs == null)
        {
            $dto = new DTO(404, "Job Not found", $jobs);
            
        }
        else
        {
            $dto = new DTO(200, "OK", $jobs);
        }
        
        //set up json encoded variable
        $json = json_encode($dto);
        
        //Return in the json format
        return response($json)->header('Content-Type', 'application/json');
    }

  
}
