<?php

/*
 * Auther: Michael Mohler
 * Date: 2/15/2021
 * 
 * Controller for user to set up an E-portfolio.
 * 
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Business\PortfolioService;
use App\Models\PortfolioModel;
use App\Services\Business\SecurityService;
use App\Services\Data\Utility\ILoggerService;

class PortfolioController extends Controller
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
     * Show the Portfolio page
     *
     * 
     */
    public function index()
    {
        $this->logger->info("Entering Portfolio Controller");
        
        //Change to specific users id so someone can view others page
        $portfolio_array = $this->showPortfolios(Auth::user()->id);
        
 
        //change to portfolio or something
        return view('eportfolio/portfolio', ['portfolios' => $portfolio_array]);
    }
    
    
    //Takes user to add page
    public function addPortfolio(Request $request)
    {
        
        return view('eportfolio/addportfolio');
    }
    
    //For security on update page.
    public function updatePortfolio()
    {
        
        
        return view('eportfolio/updatePortfolio');
    }
    
    //Takes user to update page with info
    public function updatePortfolioRedirect(Request $request)
    {

        
        return redirect('updatePortfolio')->with('oldHistory', request()->get('hiddenHistory')) 
                                            ->with('oldSkills', request()->get('hiddenSkills'))
                                            ->with('oldEducation', request()->get('hiddenEducation'));
    }
    
    
    //Displays information to the portfolio page. 
    public function showPortfolios(int $userID)
    {
        $portServ  = new PortfolioService();
        
        $this->logger->info("View Portfolio of User " .$userID);
        $portfolio_array = $portServ->viewAPortfolio($userID);
        
        return $portfolio_array;
    }
    
    //add portfolio to the 
    public function createPortfolio(Request $request)
    {
        //Makes new portfolio using informaton from page
        $portfolioData = new PortfolioModel(Auth::user()->id, request()->get('history'), request()->get('skills'), request()->get('education'));
        $this->logger->info("Creating Portfolio with History: " .$portfolioData->getHistory());
        $portServ = new PortfolioService();
        
        //Validates the portfolio by calling it from the Bussiness Layer.
        $rules = $portServ->validatePortfolio($request);
        $this->validate($request, $rules);
        
        //Adds  the Portfolio to the Database
        $portServ->addAPortfolio($portfolioData);
        
        
        
        //Setups up portfolio again for the next page
        $portfolio_array = $this->showPortfolios($portfolioData->getId());
        
        

        
        return view('eportfolio/portfolio', ['portfolios' => $portfolio_array]);  
    }
    
    
    //Updates a Portfolio
    public function changePortfolio(Request $request)
    {
        //Makes new portfolio using informaton from page
        $portfolioData = new PortfolioModel(Auth::user()->id, request()->get('history'), request()->get('skills'), request()->get('education'));
        $compare = request()->get('hiddenHistory');
        
        $this->logger->info("Updating Portfolio with History: " .$compare ."with " .$portfolioData->getHistory());
        //Calls update service
        $portServ = new PortfolioService();
        
        //Validates the portfolio by calling it from the Bussiness Layer.
        $rules = $portServ->validatePortfolio($request);
        $this->validate($request, $rules);
        
        $portServ->updateAPortfolio($portfolioData, $compare);
        
        
        
        //Setups up portfolio again for the next page
        $portfolio_array = $this->showPortfolios($portfolioData->getId());

        return view('eportfolio/portfolio', ['portfolios' => $portfolio_array]);      
    }
    
    //Displays information to the portfolio page.
    public function deletePortfolio(Request $request)
    {
        $portServ  = new PortfolioService();
        
        $portServ->deleteAPortfolio(request()->get('hiddenId') , request()->get('hiddenHistory'), );
        $this->logger->info("Deleting Portfolio with Id: " .request()->get('hiddenId'));
        
        //Reload the page, but with the new array. 
        
        //Change to specific users id so someone can view others page
        $portfolio_array = $this->showPortfolios(Auth::user()->id);
        
        
        //change to portfolio or something
        return view('eportfolio/portfolio', ['portfolios' => $portfolio_array]);
        
        
    }
    
    //Added 3-24
    //Takes user unique group page based on GET paramters
    public function specificPortfolio(Request $request)
    {
        
        $portfolio = $_GET["port"];
        $this->logger->info("Unique Portfolio Page with User Id " .$portfolio);
        
        $portServ = new PortfolioService();
        $secServ = new SecurityService();
        
        $port_array = $portServ->viewAPortfolio($portfolio);
        $user_array = $secServ->findUserDetails($portfolio);
        
        
        return view('eportfolio/uniquePortfolio', ['ports' => $port_array, 'info' => $user_array]);
    }

}
