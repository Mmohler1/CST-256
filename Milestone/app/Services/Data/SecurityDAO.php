<?php
namespace App\Services\Data;

use App\User;


class SecurityDAO
{
    //Connects to the database
    function dbConnection()
    {
        //Connects the database to the dbConn
        $dbConn = mysqli_connect("localhost", "root", "root", "dbsecu");
        
        //Check Connection Works
        if($dbConn -> connect_errno)
        {
            echo "Couldn't connect to Database: " .$dbConn -> connect_error;
            exit();
        }
        
        return $dbConn;
    }
    
    //Suspends user by adding their info to the suspended table
    public function addSuspendedUser(string $name)
    {

        
        //Connects to Database
        $dbConn = $this->dbConnection();
        
        
        //First Query checks to see if anyone is in the table with that name
        $sql = ("SELECT * FROM users
                WHERE name = '$name';");
        
        
        $result = $dbConn->query($sql);
        
        //If someone is in the database insert them into table
        if($result->num_rows > 0)
        {
            //Copies email and username from suspended user.
            $sql = ("INSERT INTO suspended (username, email)
                    SELECT name, email FROM users
                    WHERE name = '$name';");
            
            //If the query goes through then tell the user
            if ($dbConn->query($sql) === TRUE)
            {
                echo "User Suspended";
            }
            else
            {
                echo "User could not be suspended";
            }
        }
        //If not say user not found
        else
        {   
            echo "User not found";
        } 
        
        
        //Closses Connection
        $dbConn->close();

    }
    
    
    //Suspends user Permanently by removing them from users table, but keeping their details in suspended list.
    public function permSuspendUser(string $name)
    {
        
        
        //Connects to Database
        $dbConn = $this->dbConnection();
        
        
        //First Query checks to see if anyone is in the table with that name
        $sql = ("SELECT * FROM users
                WHERE name = '$name';");
        $result = $dbConn->query($sql);
        
        //If someone is in the database insert them into table
        if($result->num_rows > 0)
        {
            //Copies email and username to suspended user.
            $sql = ("INSERT INTO suspended (username, email)
                    SELECT name, email FROM users
                    WHERE name = '$name';");
            
            //Updates suspended users details to deleted
            $sql2 = ("UPDATE suspended SET deleted = 1 WHERE username = '$name';");
            
            //Deletes user from users
            $sql3 = ("DELETE FROM users WHERE name = '$name';");

            //Executes all 3 querys
            if ($dbConn->query($sql) === TRUE && $dbConn->query($sql2) === TRUE && $dbConn->query($sql3) === TRUE)
            {
          
                echo "User Permanently Suspended";
            }
            else
            {
                echo "User could not be suspended";
            }
        }
        //If not say user not found
        else
        {
            echo "User not found";
        }
        
        
        //Closses Connection
        $dbConn->close();
        
    }
    
    //Suspends user by adding their info to the suspended table
    public function addAdmin(string $name)
    {
        
        
        //Connects to Database
        $dbConn = $this->dbConnection();
        
        
        //First Query checks to see if anyone is in the table with that name
        $sql = ("SELECT * FROM users
                WHERE name = '$name';");
        
        
        $result = $dbConn->query($sql);
        
        //If someone is in the database insert them into table
        if($result->num_rows > 0)
        {
            //Copies email and name to admin.
            $sql = ("INSERT INTO admins (name, email)
                    SELECT name, email FROM users
                    WHERE name = '$name';");
            
            //If the query goes through then tell the user
            if ($dbConn->query($sql) === TRUE)
            {
                echo "User was made into an Admin";
            }
            else
            {
                echo "User could not be made into an Admin";
            }
        }
        //If not say user not found
        else
        {
            echo "User not found";
        }
        
        
        //Closses Connection
        $dbConn->close();
        
    }
    
    //Check if user has been suspended
    public function checkSuspend(string $email)
    {
        
        
        //Connects to Database
        $dbConn = $this->dbConnection();
        
        
        //First Query checks to see if anyone is in the table with that name
        $sql = ("SELECT email FROM suspended 
                    WHERE email = '$email';");
        
        
        $result = $dbConn->query($sql);
        
        //If someone is in the database insert them into table
        if($result->num_rows > 0)
        {
            return true;
        }
        //If not return false
        else
        {
            return false;
        }
        
        
        //Closses Connection
        $dbConn->close();
        
    }
}

