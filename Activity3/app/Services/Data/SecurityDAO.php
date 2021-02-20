<?php
namespace App\Services\Data;

use App\Models\UserModel;

class SecurityDAO
{
    //Connects to the database
    function dbConnection()
    {
        //Connects the database to the dbConn
        $dbConn = mysqli_connect("localhost", "root", "root", "activity2");
        
        //Check Connection Works
        if($dbConn -> connect_errno){
            echo "Couldn't connect to Database: " .$dbConn -> connect_error;
            exit();
        }
        
        return $dbConn;
    }
    
    public function findByUser(UserModel $user)
    {
        //Get variables from user
        $username = $user -> getUsername();
        $password = $user -> getPassword();
        
       
        //Connects to Database
        $dbConn = $this->dbConnection();
        
        
        //Matches username and password *NEED TO GET AND PASSWORD TO WORK
        $sql = ("SELECT * FROM USERS 
                WHERE USERNAME = '$username'
                AND PASSWORD = '$password';");
        
        $result = $dbConn->query($sql);
        
        
        
        if($result->num_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
        
        
        //Closses Connection
        $dbConn->close();
    }
}

