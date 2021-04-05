<?php
namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\Log;
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
        Log::info("Add Job with Name: " .$jobData->getName());
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
            Log::error("Add Job Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Update Job to Database
    public function updateJob(JobModel $jobData, string $compare)
    {
        Log::info("Update Job with Name: " .$compare);
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
            Log::error("Update Job Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Delete Job to Database
    public function deleteJob(int $userID, string $userjname)
    {
        Log::info("Delete Job with Name: " .$userjname);
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
            Log::error("Delete Job Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Delete all jobs from user in Database
    public function deleteAllJobs(int $userID)
    {
        Log::info("Delete All Job from User: " .$userID);
        try
        {
            
            
            $this->dbQuery = "DELETE FROM job WHERE id = '$userID'";
            
            
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
            Log::error("Delete All Jobs Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    
    //Sends job data from the database based on the users ID
    public function viewJob(int $userID)
    {
        Log::info("View Jobs with the user id : " .$userID);
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
                            $row["jname"], $row["requirement"], $row["summary"], $row["jobId"]);
                        
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
            Log::error("View Job Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    
    //Sends job data from the database based on the users ID
    public function allJobs()
    {
        Log::info("Show all Jobs");
        Log::warning("Show all Jobs has not been implemented yet.");
        try
        {
            
            $this->dbQuery = ("Select * FROM job;");
            
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
                            $row["jname"], $row["requirement"], $row["summary"], $row["jobId"]);
                        
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
            Log::error("All Jobs Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Searches for jobs based on a key word.
    public function searchJobs(string $searchTerm, int $min, int $max)
    {
        Log::info("Search Jobs with the word " .$searchTerm);
        try
        {
            
            //New list of 
            $this->dbQuery =             
                "SET @row_number=0;";
            
            //runs first Query to help make the paging system allowing each new search table to have it's own id.
            $result = $this->connection->query($this->dbQuery);
            
            
            //Nested SELECT statment that makes a new searched term table with it's own id. Then uses that as the basis for the between statement.
            $this->dbQuery = "SELECT * FROM
                        (select (@row_number:=@row_number + 1) AS number,
                        jobId, id, jname, requirement, summary FROM job
                        WHERE jname LIKE '%$searchTerm%' OR requirement LIKE '%$searchTerm%' OR summary LIKE '%$searchTerm%'
                        )AS search LIMIT $min , $max";
            
                        
            
          
            
            
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
                            $row["jname"], $row["requirement"], $row["summary"], $row["jobId"]);
                        
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
            Log::info("Job Search Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Sends job data from the database based on the users ID
    public function findAJob(int $jobID)
    {
        Log::info("Get Job Data from JobID: " .$jobID);
        try
        {
            
            $this->dbQuery = ("Select * FROM job WHERE jobId = '$jobID';");
            
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
                            $row["jname"], $row["requirement"], $row["summary"], $row["jobId"]);
                        
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
            Log::info("Find Job Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
}

