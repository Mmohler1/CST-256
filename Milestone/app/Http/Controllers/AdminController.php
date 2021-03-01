<?php

//Controller for the admin pages
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\User;

class AdminController extends Controller
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
        //Puts current list of users in an array and forwards it to the page. 
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
        $securityser ->suspendUser($id);
        
        
        $users_array = $this->showUsers();
        return view('administration/admin', ['users' => $users_array]);
    }
    
    //Suspends user Permanently based on their name
    public function doPermSuspend(Request $request)
    {
        $id = $request->input('id');
        
        
        $securityser = new SecurityService();
        $securityser ->suspendUserPerm($id);
        
        
        $users_array = $this->showUsers();
        return view('administration/admin', ['users' => $users_array]);
    }
    
    //Makes user into admin
    public function doAdmin(Request $request)
    {
        $id = $request->input('id');
        
        
        $securityser = new SecurityService();
        $securityser ->UserToAdmin($id);
        
        $users_array = $this->showUsers();
        return view('administration/admin', ['users' => $users_array]);
    }
    
    //Makes user into user
    public function doUser(Request $request)
    {
        $id = $request->input('id');
        
        
        $securityser = new SecurityService();
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
