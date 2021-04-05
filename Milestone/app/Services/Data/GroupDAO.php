<?php
namespace App\Services\Data;

use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\Log;
use App\Models\GroupModel;
use App\Services\Data\Utility\DBConnect;

/*
 * This class contains methods regarding connecting to the database
 * for accessing job postings.
 * Michael Mohler 
 * 2/15/2021
 */
class GroupDAO
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
    
    
    //Add user to Group
    public function joinGroup(GroupModel $groupData)
    {
        Log::info("Join Group named: " .$groupData->getGroupName());
        try
        {
            
            $this->dbQuery = "INSERT INTO groups (groupName, id, userName, creatorId)
                VALUES ('{$groupData->getGroupName()}',(SELECT id FROM users WHERE id = '{$groupData->getId()}'),
                (SELECT name FROM users WHERE id = '{$groupData->getId()}'), '{$groupData->getCreatorId()}')";
            
            

            
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
            Log::error("Join Group Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    

    //user leaves group by deleting them from the database
    public function leaveGroup(GroupModel $groupData)
    {
        Log::info("Leave Group named: " .$groupData->getGroupName());
        try
        {
            
            
            $this->dbQuery = "DELETE FROM groups WHERE id = '{$groupData->getId()}' AND groupName = '{$groupData->getGroupName()}'";
            
            
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
            Log::error("Leave Group Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //deletes group users and creators with this id.
    public function DeleteAllGroups(int $id)
    {
        Log::info("Delete All Groups and Members With Id: " .$id);
        try
        {
            
            
            $this->dbQuery = "DELETE FROM groups WHERE id = $id OR creatorId = $id";
            
            
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
            Log::error("Delete All Groups Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Delete Group from database
    public function deleteGroup(string $groupName, int $groupId)
    {
        Log::info("Delete Group named: " .$groupName);
        try
        {
            
            
            $this->dbQuery = "DELETE FROM groups WHERE groupName = '$groupName' AND creatorId = '$groupId'";
            
            
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
            Log::error("Delete Group Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    

    
    
    

    
    
    //make array of users in the group
    public function groupsUsers(string $groupName)
    {
        
        try
        {
            
            $this->dbQuery = ("Select * FROM groups WHERE groupName = '$groupName';");
            
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
                        $user_array[$x] = new GroupModel($row["groupName"],
                            $row["id"], $row["userName"], $row["summary"], $row["creatorId"]);
                        
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
            Log::error("Show users Group Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    
    
    //Shows each individual group for the group page
    public function allGroups()
    {
        
        try
        {
            
            $this->dbQuery = ("Select * FROM groups WHERE id = creatorId;");
            
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
                        $user_array[$x] = new GroupModel($row["groupName"],
                            $row["id"], $row["userName"], $row["summary"], $row["creatorId"]);
                        
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
            Log::error("Show All Groups Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Add group
    public function addGroup(GroupModel $groupData)
    {
        
        try
        {
            //Note, doesn't actually use the userName class put in, but pulls the name from the database itself.
            $this->dbQuery = "INSERT INTO groups (groupName, id, userName, summary, creatorId)
                VALUES ('{$groupData->getGroupName()}',(SELECT id FROM users WHERE id = '{$groupData->getId()}'),
                (SELECT name FROM users WHERE id = '{$groupData->getId()}'), '{$groupData->getSummary()}', {$groupData->getCreatorId()})";
            
            
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
            Log::error("Add Group Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    
    //update group by comparing old name with possible one. 
    public function updateGroup(GroupModel $groupData, string $compare)
    {
        
        try
        {
            
            $this->dbQuery = "Update groups
            SET groupName = '{$groupData->getGroupName()}', summary = '{$groupData->getSummary()}'
                WHERE groupName = '$compare' AND creatorId = '{$groupData->getCreatorId()}'";
            
            

            if(mysqli_query($this->connection, $this->dbQuery))
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
            Log::error("Update Group Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
}

