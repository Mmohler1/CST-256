<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use App\Models\DTO;
use App\Services\Business\PortfolioService;

//Makes a rest service for Portfolios
class EfolioRestController extends Controller
{
    /**
     * Display a listing of every job up to 10
     *
     *URL is http://localhost/Milestone/efoliorest/
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
     * URL is http://localhost/Milestone/efoliorest/{id}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //Instantiate class
        $efolioServ  = new PortfolioService();
        $efolio = $efolioServ->viewAPortfolio($id);

        
        
        
        //Print proper resposne and code for if Portfolios are found or not found. Return list of Portfolios
        if ($efolio == null)
        {
            $dto = new DTO(404, "Portfolio Not found", $efolio);
            
        }
        else
        {
            $dto = new DTO(200, "OK", $efolio);
        }
        
        //set up json encoded variable
        $json = json_encode($dto);
        
        //Return in the json format
        return response($json)->header('Content-Type', 'application/json');
    }

  
}
