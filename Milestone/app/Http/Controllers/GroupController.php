<?php

/*
 * Auther: Michael Mohler
 * Date: 2/15/2021
 * 
 * Controller for users Make and join a group
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Business\GroupService;
use App\Services\Data\Utility\ILoggerService;
use App\Models\GroupModel;

class GroupController extends Controller
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
    
    
    //////Functions releated to POSTs and GETs//////
    
    /**
     * Show the admin page
     *
     * 
     */
    public function index()
    {
        $this->logger->info("Entering Group Controller");
        
        //Calls array of groups
        $this->logger->info("Show group of array.");
        $group_array = $this->showGroups();
        
        
      
        return view('group', ['groups' => $group_array]);
        

    }
    
    
    //Takes user to update group page
    public function changeGroup(Request $request)
    {
        
        
        return view('updateGroup');
    }
    
    //Takes user to update page with info
    public function changeGroupRedirect(Request $request)
    {
        
        
        return redirect('updateGroup')->with('oldGroup', request()->get('hiddenGroup'))
        ->with('oldSummary', request()->get('hiddenSummary'))
        ->with('userName', request()->get('hiddenUserName'))
        ->with('creatorId', request()->get('hiddenId'));
    }
    
    //Takes user to add group page
    public function createGroup()
    {
        
        
        return view('addGroup');
    }
    
    //Takes user unique group page based on GET paramters
    public function specificGroup(Request $request)
    {
        
        $this->logger->info("Get Request");
        $group = $_GET["group"];
        
        $this->logger->info("Make Array of users");
        $user_array = $this->showGroupes($group);
        
        $groServ = new GroupService;
        
        
        $inGroup = $groServ->checkGroupe($group, Auth::user()->getAuthIdentifier());
        $this->logger->info("CheckUser is " .$inGroup);
        
        return view('uniqueGroup', ['groupes' => $user_array, 'checkUser' => $inGroup]);
    }
    
    
    
    //////Functions dealing with groupes//////
    
    //Add a user to the group database
    public function addGroupe(Request $request)
    {
        //Initalize Business Class
        $groServ = new GroupService;
        
        $this->logger->info("Get Request");
        $group = $_GET["group"];
        $creatorId = $_GET["creatorId"];
        
        //Make GroupData
        $groupData = new GroupModel($group, Auth::user()->getAuthIdentifier(), Auth::user()->getAuthIdentifierName(), "", $creatorId);
        
        if($groServ->joinAGroup($groupData))
        {
            $this->logger->info("Make Array of users");
            $user_array = $this->showGroupes($groupData->getGroupName());
            
            
            $inGroup = $groServ->checkGroupe($group, Auth::user()->getAuthIdentifier());
            $this->logger->info("CheckUser is " .$inGroup);
            
            return view('uniqueGroup', ['groupes' => $user_array, 'checkUser' => $inGroup]);
        }


    }
    
    //Have a user leave the group database
    public function leaveGroupe(Request $request)
    {
        //Initalize Business Class
        $groServ = new GroupService;
        
        $this->logger->info("Get Request");
        $group = $_GET["group"];
        $creatorId = $_GET["creatorId"];
        
        $this->logger->info("Make Array of users");
        //Make GroupData
        $groupData = new GroupModel($group, Auth::user()->getAuthIdentifier(), Auth::user()->getAuthIdentifierName(), "", $creatorId);
        
        if($groServ->leaveAGroup($groupData))
        {
            $user_array = $this->showGroupes($groupData->getGroupName());
            
            
            $inGroup = $groServ->checkGroupe($group, Auth::user()->getAuthIdentifier());
            $this->logger->info("CheckUser is " .$inGroup);
            
            return view('uniqueGroup', ['groupes' => $user_array, 'checkUser' => $inGroup]);
        }
        
    }
    
    
    
    
    //Returns array of users based on group name. 
    public function showGroupes(string $groupName)
    {
        
        $groServ = new GroupService;
        
        return $groServ->showGroupUsers($groupName);
        

        
    }
    
    //////Functions dealing with admin group //////
    
    //Admin updates a group and sends them back to the page page
    public function updateGroup(Request $request)
    {
        
        
        $groServ = new GroupService;
        
        $this->logger->info("Post Request");
        $groupData = new GroupModel(request()->get('groupName') , request()->get('hiddenId'), request()->get('hiddenUserName'), request()->get('summary'), request()->get('hiddenId'));
        
        //using old name to help find which table to update
        $compare = request()->get('hiddenGroup');
        
        //validates the information being put in.
        $rules = $groServ->validateGroup($request);
        $this->validate($request, $rules);
        
        //if update goes through take user to group page
        if ($groServ->updateAGroup($groupData, $compare))
        {
            $group_array = $this->showGroups();
            
            return view('group', ['groups' => $group_array]);
        }
        
    }
    
    //Admin adds a group and sends them back to the main page
    public function addGroup(Request $request)
    {
        
        $groServ = new GroupService;
        
        $this->logger->info("Post Request");
        //named parted doesn't need to be relevent, but I want to keep it here in case I change the SQL
        $groupData = new GroupModel(request()->get('groupName') , Auth::user()->getAuthIdentifier(), Auth::user()->getAuthIdentifierName(), request()->get('summary'), Auth::user()->getAuthIdentifier());
        
        //validates the information being put in.
        $rules = $groServ->validateGroup($request);
        $this->validate($request, $rules);
        
        //if add goes through take user to group page
        if ($groServ->addAGroup($groupData))
        {
            $group_array = $this->showGroups();
            
            return view('group', ['groups' => $group_array]);
        }
        
        echo "failed";
    }
    
    //Admin deletes a group and sends them back to the main page
    public function deleteGroup(Request $request)
    {
        
        
        $groServ = new GroupService;
        
        //if delete goes through take user to group page
        if ($groServ->deleteAGroup(request()->get('hiddenName') , request()->get('hiddenId') ))
        {
            $group_array = $this->showGroups();
            
            return view('group', ['groups' => $group_array]);
        }
        
    }
    
    //sends array of groups
    public function showGroups()
    {
        
        
        $groServ = new GroupService;
        
        return $groServ->showAllGroups();
        
    }
    
    
}
