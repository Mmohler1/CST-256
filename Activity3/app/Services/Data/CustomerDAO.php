<?php
namespace App\Services\Data;

use App\Models\CustomerModel;
use Carbon\Exceptions\Exception;
use App\Services\Data\Utility\DBConnect;

class CustomerDAO
{
    private $conn;
    private $dbname = "activity3";
    private $dbQuery;
    private $connection;
    private $dbObj;
    
    //Connects to the database
    public function __construct($dbObj)
    {
        $this->dbObj = $dbObj;
    }
    
    
    //Add customer to database
    public function addNewCustomer(CustomerModel $customerData)
    {
       try
       {

               
           $this->dbQuery = "INSERT INTO customer
                            (FirstName, LastName)
                            VALUE ('{$customerData->getFirstName()}', '{$customerData->getLastName()}')";

           
        if ($this->dbObj->query($this->dbQuery))
        {
            //$this->conn->closeDbConnect();
            
            return true;
            
        }
        else
        {
            //$this->conn->closeDbConnect();
            return false;
        }
        
       }
       catch(Exception $e)
       {
           echo $e->getMessage();
       }
    }
    
    //ACID
    //Get the next ID for the PK to put in the FK
    public function getNextId()
    {
        try 
        {
            // Dfine the query to get the next ID
            $this->dbQuery = "SELECT CustomerID
                              FROM customer
                               ORDER BY CustomerID DESC LIMIT 0,1";
            
            $result = $this->dbObj->query($this->dbQuery);
            
            while ($row = mysqli_fetch_array($result))
            {
                //Point to the next row thta has not been committed yet.
                return $row['CustomerID'] + 1;
            }
        }
        catch (Exception $e)
        {
            
        }
    }
}
