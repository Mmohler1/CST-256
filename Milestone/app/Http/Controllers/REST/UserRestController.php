<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use App\Models\DTO;
use App\Services\Business\SecurityService;


//Makes a rest service for Users
class UserRestController extends Controller
{
    /**
     * Display a listing of every job up to 10
     *
     *URL is http://localhost/Milestone/userrest/
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dto = new DTO(403, "Forbidden", null);

        
        
        //set up json encoded variable
        $json = json_encode($dto);
        
        //Return in the json format
        return response($json)->header('Content-Type', 'application/json');
    }

  

    /**
     * Display the specified job 
     * URL is http://localhost/Milestone/userrest/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //Instantiate class
        $secServ  = new SecurityService();
        $user = $secServ->findUserDetails($id);

        
        
        
        //Print proper resposne and code for if Users are found or not found. Return list of Users
        if ($user == null)
        {
            $dto = new DTO(404, "User Not found", $user);
            
        }
        else
        {
            $dto = new DTO(200, "OK", $user);
        }
        
        //set up json encoded variable
        $json = json_encode($dto);
        
        //Return in the json format
        return response($json)->header('Content-Type', 'application/json');
    }

  
}
