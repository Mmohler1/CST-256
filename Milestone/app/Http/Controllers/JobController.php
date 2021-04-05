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
use App\Services\Business\ApplyService;
use App\Services\Data\Utility\ILoggerService;
use App\Models\ApplyModel;

class JobController extends Controller
{
    
    protected $logger;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ILoggerService $logger)
    {
        $this->logger = $logger;
        $this->middleware('auth');
    }
    
    /**
     * Show the admin page
     *
     * 
     */
    public function index()
    {
        $this->logger->info("Entering Job Controller");
        
        //Change to specific users id so someone can view others page
        $job_array = $this->showJobs(Auth::user()->id);
        
        
      
        return view('posting/job', ['jobs' => $job_array]);
        

    }
    
    //Takes user to add page
    public function addJob()
    {
        
        
        return view('posting/addJob');
    }
    
    //Takes user to allJobs Page
    public function allJobs()
    {
        
        $jobServ  = new JobService();
        
        //Change to specific users id so someone can view others page
        $every_job = $jobServ->everyJob();
        
        
        
        return view('posting/allJobs', ['jobs' => $every_job]);
        
        
    }
    
    //Takes user to update page with info
    public function updateJob()
    {
        
        
        return view('posting/updateJob');
    }
    
    
    //Takes user to search page
    public function searchJob()
    {
        
        
        return view('posting/searchJob');
    }
    
    //Takes user to update page with info
    public function updateJobRedirect(Request $request)
    {
        
        
        return redirect('updateJob')->with('oldName', request()->get('hiddenName'))
        ->with('oldRequirement', request()->get('hiddenRequirement'))
        ->with('oldSummary', request()->get('hiddenSummary'));
    }
    
    
    //Displays information to the job page.
    public function showJobs(int $userID)
    {
        $jobServ  = new JobService();
        $this->logger->info("Show jobs from " .$userID);
        $job_array = $jobServ->viewAJob($userID);
        
        return $job_array;
    }
    
    //Takes user to add page
    public function jobApplied()
    {
        
        
        return view('applied');
    }
    
    //add job to the database
    public function createJob(Request $request)
    {
        //Makes new Job using informaton from page
        $jobData = new JobModel(Auth::user()->id, request()->get('name'), request()->get('requirement'), request()->get('summary'), 0);
        $this->logger->info("Creating Job called: " .$jobData->getName());
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
        $jobData = new JobModel(Auth::user()->id, request()->get('name'), request()->get('requirement'), request()->get('summary'), 0);
        $compare = request()->get('hiddenName');
        $this->logger->info("Updating Job called: " .$compare ."with " .$jobData->getName());
        
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
        $appServ = new ApplyService();
        
        $appServ->deleteAllApply(request()->get('hiddenJobInfo')); //Deletes all applicants there
        $jobServ->deleteAJob(request()->get('hiddenId') , request()->get('hiddenName'));
        $this->logger->info("Delete Job id: " .request()->get('hiddenId'));
        
        
        //Reload the page, but with the new array.
        
        //Change to specific users id so someone can view others page
        $job_array = $this->showJobs(Auth::user()->id);
        
        
        //change to job or something
        return view('posting/job', ['jobs' => $job_array]);
   
        
    }
    
    //Takes user to the search Job page, but with just the one's they searched for.
    public function lookJob(Request $request)
    {
        $this->logger->info("Job Search");
        
        //Validates that the search is not empty
        $rules = [
            'search' => 'Required | Between: 1, 255',
        ];
        $this->validate($request, $rules);
        
        
        $searchTerm = $_GET["search"];
        $page = $_GET["page"];
        
        $this->logger->info("On Page " .$page);
        // Only show a total of 3 jobs so use some math for Limit min , max
        $max = 3;
        $min = ($page-1) * $max;
        
        $jobServ  = new JobService();
              
        $totalFound = count($jobServ->findJobs($searchTerm, 0, 14)); // looks for, at the most, 15 jobs and puts them in an array
        
        $pageNumbers = ceil($totalFound / $max); //Divid by 3 and round up to decide how many pages are needed
        
        //returns list of jobs around keyword
        $some_jobs = $jobServ->findJobs($searchTerm, $min, $max);
        
        
               
        return view('posting/searchedJobs', ['jobs' => $some_jobs, 'searchTerm' => $searchTerm, 'pageNumbers' =>  $pageNumbers, 'onPage' => $page] );
            
    }
    
    //Takes user unique job page based on GET paramters
    public function specificJob(Request $request)
    {
        
        $jobID = $_GET["jobid"];
        
        $this->logger->info("Unique Job Page Id " .$jobID);
        $jobServ = new JobService;
        $appServ = new ApplyService();
        
        $job_array = $jobServ->lookForJob($jobID); //lists jobs info
        $apply_array = $appServ->displayApply($jobID); //List applicants for job creator
        
        $inApply = $appServ->checkApply($jobID, Auth::user()->getAuthIdentifier());

        return view('posting/uniqueJob', ['aJob' => $job_array, 'aApply' => $apply_array,'checkUser' => $inApply]);
    }
    
    //Takes user unique job page based on GET paramters
    public function ApplyJob(Request $request)
    {
        $this->logger->info("Applying to Job");
        $jobID = request()->get('JobId');
        $userID = request()->get('UserId');
        
        
        $appServ = new ApplyService();
        
        
        $applyData = new ApplyModel(0, $jobID, $userID, "other", "other"); //3 of these aren't needed for inserting

        $appServ->joinApply($applyData); //Add apply to database
        
        return view('applied');
    }
    
    //For creator to delete applicant 
    public function deleteApply(Request $request)
    {
        $this->logger->info("Removing Application");
        $jobID = $_GET["jobid"];
        $applyID = $_GET["applyid"];
        
        
        $jobServ = new JobService;
        $appServ = new ApplyService();
        
        $applyData = new ApplyModel($applyID, $jobID, 0, "other", "other"); //3 of these aren't needed for deleting
        
        $appServ->removeApply($applyData); //deletes user
        
        //Same as view page. 
        $job_array = $jobServ->lookForJob($jobID); //lists jobs info
        $apply_array = $appServ->displayApply($jobID); //List applicants for job creator
        
        $inApply = $appServ->checkApply($jobID, Auth::user()->getAuthIdentifier());
        
        return view('posting/uniqueJob', ['aJob' => $job_array, 'aApply' => $apply_array,'checkUser' => $inApply]);
        
    }
    
    
}
