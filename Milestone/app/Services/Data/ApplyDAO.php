<?php
namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\Log;
use App\Models\ApplyModel;
use App\Services\Data\Utility\DBConnect;

/*
 * This class contains methods regarding connecting to the database
 * for accessing job postings.
 * Michael Mohler 
 * 2/15/2021
 */
class ApplyDAO
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
    
    
    //Add user to apply
    public function addApply(ApplyModel $applyData)
    {
        Log::info("Add Apply for JobId: " .$applyData->getJobId());
        try
        {
            
            $this->dbQuery = "INSERT INTO apply (jobId, id, email, name)
                VALUES ('{$applyData->getJobId()}', '{$applyData->getId()}', 
                (SELECT email FROM users WHERE id = '{$applyData->getId()}'), 
                (SELECT name FROM users WHERE id = '{$applyData->getId()}'))";


            
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
            Log::error("Add Apply Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    

    //Delete Application
    public function deleteApply(ApplyModel $applyData)
    {
        Log::info("Delete Apply From ApplyId: " .$applyData->getApplyId());
        try
        {
            
            
            $this->dbQuery = "DELETE FROM apply WHERE applyId = '{$applyData->getApplyId()}'";
            
            
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
            Log::error("Delete Apply Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    
    
    
    

    
    
    //make array of applicants in a certin job
    public function showApply(int $jobId)
    {
        
        try
        {
            Log::info("Show applicants for JobId: " .$jobId);
            
            $this->dbQuery = ("Select * FROM apply WHERE jobId = '$jobId';");
            
            //Setup the array
            $user_array = [];
            
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
                        $user_array[$x] = new ApplyModel($row["applyId"],
                            $row["jobId"], $row["id"], $row["email"], $row["name"]);
                        
                        //increment ammount
                        $x = $x + 1;
                    }
                    
                    $this->conn->closeDbConnect();
                    return $user_array;
                }
                else
                {
                    $this->conn->closeDbConnect();
                    return $user_array;
                }
            }
            else
            {
                $this->conn->closeDbConnect();
                return $user_array;
            }
            
        }
        catch(Exception $e)
        {
            Log::error("Show Apply Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    
    //Delete every Applications for a certin job
    public function deleteAllApply(int $jobId)
    {
        Log::info("Delete all Apply for JobId: " .$jobId);
        try
        {
            
            
            $this->dbQuery = "DELETE FROM apply WHERE jobId = '$jobId'";
            
            
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
            Log::error("Delete All Apply Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
   
    
}

