<?php

//Controller for the admin pages
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\Services\Business\PortfolioService;
use App\Services\Business\JobService;
use App\Services\Business\GroupService;
use App\Services\Business\ApplyService;
use App\Services\Data\Utility\ILoggerService;


class AdminController extends Controller
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
        $this->logger->info("Entering Admin Controller");
        
        //Puts current list of users in an array and forwards it to the page. 
        $this->logger->info("Show list of users");
        $users_array = $this->showUsers();
        return view('administration/admin', ['users' => $users_array]);
    }
    
    public function suspended()
    {
        return view('/suspended');
    }
    
    
    //Suspends user based on their name
    public function trySuspend(Request $request)
    {
        $id = $request->input('id');
        
        
        $securityser = new SecurityService();
        
        $this->logger->info("Suspend User");
        $securityser ->suspendUser($id);
        
        
        $users_array = $this->showUsers();
        return view('administration/admin', ['users' => $users_array]);
    }
    
    //Suspends user Permanently based on their name
    public function doPermSuspend(Request $request)
    {
        $id = $request->input('id');
        
        
        $securityser = new SecurityService();
        $portServ = new PortfolioService();
        $jobServ = new JobService();
        $groupServ = new GroupService();

        $this->logger->info("Deleting info for the user with ID: ".$id);
        $this->logger->info("Delete All Suspended User's Portfolios");
        $portServ->deleteAllPortfolio($id);
        $this->logger->info("Delete All Suspended User's Job");
        $jobServ->deleteAllJob($id);
        $this->logger->info("Delete All Suspended User's groups");
        $groupServ->deleteAllGroup($id);
        $this->logger->info("Delete Suspended User");
        $securityser->suspendUserPerm($id);
        
        $this->logger->info("Show list of users");
        $users_array = $this->showUsers();
        return view('administration/admin', ['users' => $users_array]);
    }
    
    //Makes user into admin
    public function doAdmin(Request $request)
    {
        $id = $request->input('id');
        
        
        $securityser = new SecurityService();
        $this->logger->info("Making user admin with Id:" .$id);
        $securityser ->UserToAdmin($id);
        
        
        $users_array = $this->showUsers();
        return view('administration/admin', ['users' => $users_array]);
    }
    
    //Makes user into user
    public function doUser(Request $request)
    {
        $id = $request->input('id');
        
        
        $securityser = new SecurityService();
        $this->logger->info("Making user's role user with Id:" .$id);
        $securityser ->roleToUser($id);
        
        
        $users_array = $this->showUsers();
        return view('administration/admin', ['users' => $users_array]);
    }
    

    //returns array of users.
    public function showUsers()
    {
        
        
        $securityser = new SecurityService();
        return $securityser ->showTheUsers();
        
        
    }
    

}
