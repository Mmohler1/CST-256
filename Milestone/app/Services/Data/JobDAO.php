<?php
namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use App\Models\JobModel;
use App\Services\Data\Utility\DBConnect;

/*
 * This class contains methods regarding connecting to the database
 * for accessing job postings.
 * Michael Mohler 
 * 2/15/2021
 */
class JobDAO
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
    
    
    //Add Job to Database
    public function addJob(JobModel $jobData)
    {
        
        try
        {
            
            $this->dbQuery = "INSERT INTO job (id, jname, requirement, summary)
                VALUES ((SELECT id FROM users WHERE id = '{$jobData->getId()}'),
                '{$jobData->getName()}', '{$jobData->getRequirement()}', '{$jobData->getSummary()}')";
            
            
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
            echo $e->getMessage();
        }
    }
    
    //Update Job to Database
    public function updateJob(JobModel $jobData, string $compare)
    {
        
        try
        {
            
            
            $this->dbQuery = "Update job
                SET jname = '{$jobData->getName()}', requirement = '{$jobData->getRequirement()}', summary = '{$jobData->getSummary()}'
                WHERE jname = '$compare' AND id = '{$jobData->getId()}';";
            
            
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
            echo $e->getMessage();
        }
    }
    
    //Delete Job to Database
    public function deleteJob(int $userID, string $userjname)
    {
        
        try
        {
            
            
            $this->dbQuery = "DELETE FROM job WHERE id = '$userID' AND jname = '$userjname'";
            
            
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
            echo $e->getMessage();
        }
    }
    
    
    //Sends portfolia data from the database based on the users ID
    public function viewJob(int $userID)
    {
        
        try
        {
            
            $this->dbQuery = ("Select * FROM job WHERE id = '$userID';");
            
            //Setup the array
            $job_array = [];
            
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
                        $job_array[$x] = new JobModel($row["id"],
                            $row["jname"], $row["requirement"], $row["summary"]);
                        
                        //increment ammount
                        $x = $x + 1;
                    }
                    
                    $this->conn->closeDbConnect();
                    return $job_array;
                }
                else
                {
                    $this->conn->closeDbConnect();
                    return $job_array;
                }
            }
            else
            {
                $this->conn->closeDbConnect();
                return $job_array;
            }
            
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
}
