<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\SecurityService;

//Controller for the login page
class LoginController extends Controller
{
    public function index(Request $request)
    {
        //saves request info as usernamed and password
        $username = $request->input('username');
        $password = $request->input('password');
        
        /* echo "Username: " . $username;
        
        echo '<br>';
        echo "Password: " . $password; */
        
        
        //Creates new user to be used to pass into other functions
        $user = new UserModel($username, $password);
        
        
        //Creates security service to use the functions. 
        $secServ = new SecurityService; 
        //checks the login with the users in the database
        $checkUser = $secServ->login($user);
        
        //If true view passed, if wrong view failed
        if($checkUser)
        {
            //returns loginPassed, with the user credidentals passed as model
            return view('loginPassed2', [ "model" => $user ]);
        }
        else
        {
            return view('loginFailed');
        }
        
        
    }
}
