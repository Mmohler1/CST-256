<?php
namespace App\Services\Data;
use App\Models\UserModel;
use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\Log;

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
    public function addSuspendedUser(int $id)
    {
        
        Log::info("Update User's Role to Suspended with Id: " .$id);
        try
        {
            //Connects to Database
            $dbConn = $this->dbConnection();
            
            
            //First Query checks to see if anyone is in the table with that id
            $sql = ("SELECT * FROM users
                    WHERE id = '$id';");
            
            
            $result = $dbConn->query($sql);
            
            //If someone is in the database insert them into table
            if($result->num_rows > 0)
            {
                //Updates role to suspended
                $sql = ("UPDATE users
                SET roles = 'suspended'
                WHERE id = '$id'; ");
                
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
        catch(Exception $e)
        {
            Log::error("Suspend User Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    
    //Suspends user Permanently by removing them from users table.
    public function permSuspendUser(int $id)
    {
        Log::info("Delete User with Id: " .$id);
        try {
            
            //Connects to Database
            $dbConn = $this->dbConnection();
            
            
            //First Query checks to see if anyone is in the table with that id
            $sql = ("SELECT * FROM users
                    WHERE id = '$id';");
            $result = $dbConn->query($sql);
            
            //If someone is in the database insert them into table
            if($result->num_rows > 0)
            {
    
                //Deletes user from users
                $sql = ("DELETE FROM users WHERE id = '$id';");
    
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
        catch(Exception $e)
        {
            Log::error("Permanently Suspend User Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Suspends user by adding their info to the suspended table
    public function addAdmin(int $id)
    {
        Log::info("Update User's Role to Admin with Id: " .$id);
        try {
            
            //Connects to Database
            $dbConn = $this->dbConnection();
            
            
            //First Query checks to see if anyone is in the table with that id
            $sql = ("SELECT * FROM users
                    WHERE id = '$id';");
            
            
            $result = $dbConn->query($sql);
            
            //If someone is in the database insert them into table
            if($result->num_rows > 0)
            {
                //Updates role to admin
                $sql = ("UPDATE users
                SET roles = 'admin'
                WHERE id = '$id'; ");
                
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
        catch(Exception $e)
        {
            Log::error("Make Admin Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Make user a user by changing thier role
    public function addUser(int $id)
    {
        Log::info("Update User's Role to User with Id: " .$id);
        try {
            //Connects to Database
            $dbConn = $this->dbConnection();
            
            
            //First Query checks to see if anyone is in the table with that id
            $sql = ("SELECT * FROM users
                    WHERE id = '$id';");
            
            
            $result = $dbConn->query($sql);
            
            //If someone is in the database insert them into table
            if($result->num_rows > 0)
            {
                //Updates role to admin
                $sql = ("UPDATE users
                SET roles = 'user'
                WHERE id = '$id'; ");
                
                //If the query goes through then tell the user
                if ($dbConn->query($sql) === TRUE)
                {
                    echo "User was made into a user";
                }
                else
                {
                    echo "User could not be made into a User";
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
        catch(Exception $e)
        {
            Log::error("Make User a User Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Check if user is admin or suspended
    public function checkRole(string $email)
    {
        Log::info("Check User's Role with email: " .$email);
        try {
            //Connects to Database
            $dbConn = $this->dbConnection();
            
            
            //First Query checks to see if anyone is in the table with that id
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
        catch(Exception $e)
        {
            Log::error("Check Role Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Shows list of all users
    public function showUsers()
    {
        Log::info("Show List of Users");
        try {
            //Setup the array
            $users_array = [];
            
            //Connects to Database
            $dbConn = $this->dbConnection();
            
            
            //First Query checks to see if anyone is in the table with that id
            $sql = ("SELECT id, name, email, roles FROM users;");
            
            
            $result = $dbConn->query($sql);
            
            //If someone is in the database insert them into table
            if($result->num_rows > 0)
            {
                //for loop
                $x = 0;
                //loop for all results
                while($row = $result->fetch_assoc())
                {
                    //Save array as the model
                    $users_array[$x] = new UserModel($row["id"],
                        $row["name"], $row["roles"], $row["email"]);
                    
                    //increment ammount
                    $x = $x + 1;
                }
                
            }
    
            
            //Closses Connection
            $dbConn->close();
            return $users_array;
        }
        catch(Exception $e)
        {
            Log::error("Show Users Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    //Date 3-24
    //returns users name and email based on ID.
    public function getUserDetails(int $userID)
    {
        Log::info("Get User's details with Id: " .$userID);
        try 
        {
            //Setup the array
            $users_array = [];
            
            //Connects to Database
            $dbConn = $this->dbConnection();
            
            
            //First Query checks to see if anyone is in the table with that id
            $sql = ("SELECT id, name, email, roles FROM users WHERE id = '$userID';");
            
            
            $result = $dbConn->query($sql);
            
            //If someone is in the database insert them into table
            if($result->num_rows > 0)
            {
                //for loop
                $x = 0;
                //loop for all results
                while($row = $result->fetch_assoc())
                {
                    //Save array as the model
                    $users_array[$x] = new UserModel($row["id"],
                        $row["name"], $row["roles"], $row["email"]);
                    
                    //increment ammount
                    $x = $x + 1;
                }
                
            }
            
            
            //Closses Connection
            $dbConn->close();
            return $users_array;
        }
        catch(Exception $e)
        {
            Log::error("User Details Error Message: " .$e->getMessage());
            echo $e->getMessage();
        }
    }
}

