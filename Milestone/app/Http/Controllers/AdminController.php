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
        return view('administration/admin');
    }
    
    public function suspended()
    {
        return view('/suspended');
    }
    
    
    //Suspends user based on their name
    public function trySuspend(Request $request)
    {
        $username = $request->input('username');
        
        
        $securityser = new SecurityService();
        $securityser ->suspendUser($username);
        
        return view("administration/admin");
    }
    
    //Suspends user Permanently based on their name
    public function doPermSuspend(Request $request)
    {
        $username = $request->input('username');
        
        
        $securityser = new SecurityService();
        $securityser ->suspendUserPerm($username);
        
        return view("administration/admin");
    }
    
    //Makes user into admin
    public function doAdmin(Request $request)
    {
        $username = $request->input('username');
        
        
        $securityser = new SecurityService();
        $securityser ->UserToAdmin($username);
        
        return view("administration/admin");
    }
    

    

}
