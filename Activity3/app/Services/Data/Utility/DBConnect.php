<?php
namespace App\Services\Data\Utility;

//use App\Models\CustomerModel;
//use Carbon\Exceptions\Exception;
use mysqli;

class DBConnect
{
    private $conn;
    private $servername;
    private $username;
    private $password;
    private $dbname;
    
    //Connects to the database
    public function __construct(string $dbname)
    {
        
        //initalize properites.
        
        $this->dbname = $dbname;
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "root";
        
       
    }
    
    public function getDbConnect()
    {
        // OOP Style programming
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        
        //$this->conn = mysqli_connect("localhost", "root", "root", $this->dbname);
        
        if($this-> conn->connect_errno)
        {
            echo "Failed to connect to mysql" .$this->conn->connect_errno;
        }
        return($this->conn);
    }
    
    /*
     * Close the connection
     */
    public function closeDbConnect()
    {
        //OOP style
        $this->conn->close();
        
    }
    
    //Turn Auto Commit On
    public function setDbAutocommitTrue()
    {
        //Turn Auto Commit On
        $this->conn->autocommit(TRUE);
    }
    
    //Turn Auto Commit Off
    public function setDbAutocommitFalse()
    {
        //Turn Auto Commit Off
        $this->conn->autocommit(FALSE);
    }
    
    
    //Begin Transaction
    public function beginTransaction()
    {
        $this->conn->begin_transaction();
    }
    
    //Commit Transaction
    public function commitTransaction()
    {
        $this->conn->commit();
    }
    
    //Rollback Transaction
    public function rollbackTransaction()
    {
        $this->conn->rollback();
    }
    
}

