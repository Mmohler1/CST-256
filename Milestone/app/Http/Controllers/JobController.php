<?php

/*
 * Auther: Michael Mohler
 * Date: 2/15/2021
 * 
 * Controller for users to set up job postings
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Business\JobService;
use App\Models\JobModel;

class JobController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the admin page
     *
     * 
     */
    public function index()
    {
        //Change to specific users id so someone can view others page
        $job_array = $this->showJobs(Auth::user()->id);
        
        
      
        return view('posting/job', ['jobs' => $job_array]);
        

    }
    
    //Takes user to add page
    public function addJob()
    {
        
        
        return view('posting/addJob');
    }
    
    public function allJobs()
    {
        
        $jobServ  = new JobService();
        
        //Change to specific users id so someone can view others page
        $every_job = $jobServ->everyJob();
        
        
        
        return view('posting/job', ['jobs' => $every_job]);
        
        
    }
    
    //Takes user to update page with info
    public function updateJob()
    {
        
        
        return view('posting/updateJob');
    }
    
    
    //Takes user to update page with info
    public function updateJobRedirect(Request $request)
    {
        
        
        return redirect('posting/updateJob')->with('oldName', request()->get('hiddenName'))
        ->with('oldRequirement', request()->get('hiddenRequirement'))
        ->with('oldSummary', request()->get('hiddenSummary'));
    }
    
    
    //Displays information to the job page.
    public function showJobs(int $userID)
    {
        $jobServ  = new JobService();
        
        $job_array = $jobServ->viewAJob($userID);
        
        return $job_array;
    }
    
    //add job to the database
    public function createJob(Request $request)
    {
        //Makes new Job using informaton from page
        $jobData = new JobModel(Auth::user()->id, request()->get('name'), request()->get('requirement'), request()->get('summary'));
        
        $jobServ = new JobService();
        
        //Checks Validations
        $rules = $jobServ->validateJob($request);
        $this->validate($request, $rules);
        
        //Adds Job
        $jobServ->addAJob($jobData);
        
        
        
        //Setups up job again for the next page
        $job_array = $this->showJobs($jobData->getId());
        
        return view('posting/job', ['jobs' => $job_array]);
    }
    
    
    //Updates a job
    public function changejob(Request $request)
    {
        //Makes new job using informaton from page
        $jobData = new JobModel(Auth::user()->id, request()->get('name'), request()->get('requirement'), request()->get('summary'));
        $compare = request()->get('hiddenName');
        
        //Calls update service
        $jobServ = new JobService();
        
        
        //Checks Validations
        $rules = $jobServ->validateJob($request);
        $this->validate($request, $rules);
        
        //Updates service
        $jobServ->updateAJob($jobData, $compare);
        
        
        
        //Setups up job again for the next page
        $job_array = $this->showJobs($jobData->getId());
        
        return view('posting/job', ['jobs' => $job_array]);
    }
    
    //Displays information to the job page.
    public function deleteJob(Request $request)
    {
        $jobServ  = new JobService();
        
        $jobServ->deleteAJob(request()->get('hiddenId') , request()->get('hiddenName') );
        
        
        //Reload the page, but with the new array.
        
        //Change to specific users id so someone can view others page
        $job_array = $this->showJobs(Auth::user()->id);
        
        
        //change to job or something
        return view('posting/job', ['jobs' => $job_array]);
   
        
    }
    
}
