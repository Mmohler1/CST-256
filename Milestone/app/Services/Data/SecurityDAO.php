<?php
namespace App\Services\Data;


/*
 * This class contains methods regarding connecting to the database.
 * Michael Mohler 
 * 2/11/2021
 */
class SecurityDAO
{
    
    private $dbHost;
    private $dbUser;
    private $dbPassword;
    private $dbDatabase;
    
    
    //Connects to the database
    function dbConnection()
    {
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPassword = "root";
        $dbDatabase = "dbsecu";
        
        /* To get this to work on Azure
        $dbHost = "localhost:55310";
        $dbUser = "azure";
        $dbPassword = "6#vWHD_$";
        $dbDatabase = "dbsecu";
        */
        
        //Connects the database to the dbConn
        $dbConn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDatabase);
        
        //Check Connection Works
        if($dbConn -> connect_errno)
        {
            echo "Couldn't connect to Database: " .$dbConn -> connect_error;
            exit();
        }
        
        return $dbConn;
    }
    
    //Suspends user by adding it to their role
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
            //Updates role to suspended
            $sql = ("UPDATE users
            SET roles = 'suspended'
            WHERE name = '$name'; ");
            
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
    
    
    //Suspends user Permanently by removing them from users table.
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

            //Deletes user from users
            $sql = ("DELETE FROM users WHERE name = '$name';");

            //Executes all 3 querys
            if ($dbConn->query($sql) === TRUE)
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
            //Updates role to admin
            $sql = ("UPDATE users
            SET roles = 'admin'
            WHERE name = '$name'; ");
            
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
    
    //Check if user is admin or suspended
    public function checkRole(string $email)
    {
        
        
        //Connects to Database
        $dbConn = $this->dbConnection();
        
        
        //First Query checks to see if anyone is in the table with that name
        $sql = ("SELECT roles FROM users 
                    WHERE email = '$email';");
        
        
        $result = $dbConn->query($sql);
        
        //If someone is in the database insert them into table
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {       
            
            return $row["roles"];
            }
        }
        else
        {
            return "";
        }
        
        //Closses Connection
        $dbConn->close();
        
    }
}

