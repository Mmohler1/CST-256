<?php
namespace App\Services\Business;


use App\Models\UserModel;
use App\Models\CustomerModel;
use App\Services\Data\SecurityDAO;
use App\Services\Data\CustomerDAO;
use App\Services\Data\OrderDAO;
use App\Services\Data\Utility\DBConnect;

//Bussiness class that runs the function from the DAO
class SecurityService
{
    public function login(UserModel $user)
    {
        //Created to use DAO, then run findByUser function.
        $secDao = new SecurityDAO;
        $anyUser = $secDao->findByUser($user);
        
        //returns bool if user exists. 
        return $anyUser;
    }
    
    //manage customer data in bus layer
    public function addCustomer(CustomerModel $customerData)
    {
        
        
        $cusDao = new CustomerDAO;
        $anyUser = $cusDao->addNewCustomer($customerData);
        
        //returns bool if user exists.
        return $anyUser;
    }
    
    //manage customer data in bus layer
    public function addOrder(string $product, int $customerID)
    {
        
        
        $ordDao = new OrderDAO;
        $orderUser = $ordDao->addOrder($product, $customerID);
        
        //returns bool if user exists.
        return $orderUser;
    }
    
    //Manage our ACID
    public function addAllInformation(string $product, int $customerID, CustomerModel $customerData)
    {
        //Create a connectin to the database
        //Create instance
        
        $conn = new DBConnect('activity3');
        
        //Call method ot create a connection
        $dbObj = $conn->getDbConnect();
        
        //first turn off AutoCommit
        $conn->setDbAutocommitFalse();
        
        //Begin transaction 
        $conn->beginTransaction();
        
        
        //Instatiate data access layer
        
        $this->addTheCustomer = new CustomerDAO($dbObj);
        $customerID = $this->addTheCustomer->getNextId();
        
        //Add the customer data 
        
        $isSuccessful = $this->addTheCustomer->addNewCustomer($customerData);
        
        //Instantiate data access layer for data DAO
        $this->addNewOrder = new OrderDAO($dbObj);
        
        //add product order data
        $isSuccessfulOrder = $this->addNewOrder->addOrder($product, (int)$customerID); //this one isn't working
        
        
        
        if($isSuccessful && $isSuccessfulOrder)
        {
            $conn->commitTransaction();
            return true;
        }
        else
        {
            $conn->rollbackTransaction();
            return false;
        }
    }
}

