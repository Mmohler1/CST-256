<?php
namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\Log;
use App\Models\PortfolioModel;
use App\Services\Data\Utility\DBConnect;


/*
 * This class contains methods regarding connecting to the database
 * for accessing users portfolios.
 * Michael Mohler 
 * 2/15/2021
 */
class PortfolioDAO
{
    private $conn;
    private $dbname = "dbSecu";
    private $dbQuery;
    private $connection;
    
    //Connects to the database
    public function __construct()
    {
        //Create a conneciton to the databae
        //Create an instance of the class
        $this->conn = new DBConnect($this->dbname);
        
        //Call method to create the connection
        $this->connection = $this->conn->getDbConnect();
    }
 
    
    //Add Portfolio to Database
    public function addPortfolio(PortfolioModel $portfolioData)
    {
        Log::info("Add Portfolio for user: " .$portfolioData->getId());
        try
        { 
            
            $this->dbQuery = "INSERT INTO efolio (id, History, Skills, Education)
                VALUES ((SELECT id FROM users WHERE id = '{$portfolioData->getId()}'), 
                '{$portfolioData->getHistory()}', '{$portfolioData->getSkills()}', '{$portfolioData->getEducation()}')";
            
            
            if (mysqli_query($this->connection, $this->dbQuery))
            {
                $this->conn->closeDbConnect();
                return true;
                
            }
            else
            {
                $this->conn->closeDbConnect();
                return false;
            }
            
        }
        catch(Exception $e)
        {
            Log::error("Add Portfolio Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Update Portfolio to Database
    public function updatePortfolio(PortfolioModel $portfolioData, string $compare)
    {
        Log::info("Update Portfolio for user: " .$portfolioData->getId());
        try
        {
              
            
            $this->dbQuery = "Update efolio
                SET History = '{$portfolioData->getHistory()}', Skills = '{$portfolioData->getSkills()}', Education = '{$portfolioData->getEducation()}'
                WHERE History = '$compare' AND id = '{$portfolioData->getId()}';";
            
            
            if (mysqli_query($this->connection, $this->dbQuery))
            {
                $this->conn->closeDbConnect();
                return true;
                
            }
            else
            {
                $this->conn->closeDbConnect();
                return false;
            }
            
        }
        catch(Exception $e)
        {
            Log::error("Update Portfolio Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Delete Portfolio to Database
    public function deletePortfolio(int $userID, string $userHistory)
    {
        Log::info("Delete Portfolio for user: " .$userID);
        try
        {
            
            
            $this->dbQuery = "DELETE FROM efolio WHERE id = '$userID' AND History = '$userHistory'";
            
            
            if (mysqli_query($this->connection, $this->dbQuery))
            {
                $this->conn->closeDbConnect();
                return true;
                
            }
            else
            {
                $this->conn->closeDbConnect();
                return false;
            }
            
        }
        catch(Exception $e)
        {
            Log::error("Delete Portfolio Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Delete Portfolio to Database
    public function deleteAllPortfolio(int $userID)
    {
        Log::info("Delete Portfolio for user: " .$userID);
        try
        {
            
            
            $this->dbQuery = "DELETE FROM efolio WHERE id = '$userID'";
            
            
            if (mysqli_query($this->connection, $this->dbQuery))
            {
                $this->conn->closeDbConnect();
                return true;
                
            }
            else
            {
                $this->conn->closeDbConnect();
                return false;
            }
            
        }
        catch(Exception $e)
        {
            Log::error("Delete All Portfolio Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Sends portfolia data from the database based on the users ID
    public function viewPortfolio(int $userID)
    {
        Log::info("Show Portfolio for user: " .$userID);
        try
        {
              
            $this->dbQuery = ("Select * FROM efolio WHERE id = '$userID';");
           
            //Setup the array
            $portfolio_array = [];
            
            if (mysqli_query($this->connection, $this->dbQuery))
            {
                
                //Saves information in this variable
                $result = $this->connection->query($this->dbQuery);
                

                
                //If someone is in the database insert them into table
                if($result->num_rows > 0)
                {

                    
                    //for loop
                    $x = 0;
                    //loop for all results
                    while($row = $result->fetch_assoc())
                    {
                        //Save array as the model
                        $portfolio_array[$x] = new PortfolioModel($row["id"],
                            $row["History"], $row["Skills"], $row["Education"]);
                        
                        //increment ammount
                        $x = $x + 1;
                    }
                    
                    $this->conn->closeDbConnect();
                    return $portfolio_array;
                }
                else
                {
                    $this->conn->closeDbConnect();
                    return $portfolio_array;
                }
            }
            else
            {
                $this->conn->closeDbConnect();
                return $portfolio_array;
            }
            
        }
        catch(Exception $e)
        {
            Log::error("Show Portfolios Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
  
 
}

