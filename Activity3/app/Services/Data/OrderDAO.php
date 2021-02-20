<?php
namespace App\Services\Data;

//use App\Models\CustomerModel;
use Carbon\Exceptions\Exception;
use App\Services\Data\Utility\DBConnect;

class OrderDAO
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
    public function addOrder(string $product, int $customerID)
    {
       try
       {

           
            
           $this->dbQuery = @"INSERT INTO `orders`
                            (Product, CustomerID)
                            VALUES 
                            ('" . $product . "', ". $customerID . ")";

           
           
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
}
