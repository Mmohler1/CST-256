<?php
namespace App\Services\Business;


use App\Models\PortfolioModel;
use App\Services\Data\PortfolioDAO;
use Illuminate\Http\Request;

//Bussiness class that runs the functions from the DAO for the Portfolio
class PortfolioService
{
   
    public function addAPortfolio(PortfolioModel $portfolioData)
    {
        $portDAO  = new PortfolioDAO();
        
        return $portDAO->addPortfolio($portfolioData);
        
    }
    
    public function updateAPortfolio(PortfolioModel $portfolioData, string $compare)
    {
        $portDAO  = new PortfolioDAO();
        
        return $portDAO->updatePortfolio($portfolioData, $compare);
        
    }
    
    public function deleteAPortfolio(int $userID, string $userHitory)
    {
        $portDAO  = new PortfolioDAO();
        
        return $portDAO->deletePortfolio($userID, $userHitory);
        
    }
    
    public function deleteAllPortfolio(int $userID)
    {
        $portDAO  = new PortfolioDAO();
        
        return $portDAO->deleteAllPortfolio($userID);
        
    }
    
    //Returns array of portfolio list matching userID
    public function viewAPortfolio(int $userID)
    {
        $portDAO  = new PortfolioDAO();
        
        return $portDAO->viewPortfolio($userID);         
    }
    

    
    //Validation Rules to be returned to the
    public function validatePortfolio(Request $request)
    {
        //setup Data Validation Rules for Login Form
        $rules = [
            'history' => 'Required | Between: 4, 250',
            'skills' => 'Required | Between: 5, 250',
            'education' => 'Required | Between: 5, 250',
        ];
        
        return $rules;

    }
}

