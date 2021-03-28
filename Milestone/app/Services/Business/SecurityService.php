<?php
namespace App\Services\Business;


use App\Services\Data\SecurityDAO;

//Bussiness class that runs the function from the DAO
class SecurityService
{
    //Suspends a user that is put in.
    public function suspendUser(int $id)
    {
        //Created to use DAO, then run function.
        $secDao = new SecurityDAO;
        $secDao->addSuspendedUser($id);
        
    }
    
    //Suspends a user that is put in.
    public function userToAdmin(int $id)
    {
        //Created to use DAO, then run function.
        $secDao = new SecurityDAO;
        $secDao->addAdmin($id);
        
    }
    
    //Suspends a user that is put in.
    public function roleToUser(int $id)
    {
        //Created to use DAO, then run function.
        $secDao = new SecurityDAO;
        $secDao->addUser($id);
        
    }
    
    //Suspends a user that is put in.
    public function suspendUserPerm(int $id)
    {
        //Created to use DAO, then run function.
        $secDao = new SecurityDAO;
        $secDao->permSuspendUser($id);
        
    }
    
    //checks role of user
    public function checkWhatRole(string $email)
    {
        //Created to use DAO, then run function.
        $secDao = new SecurityDAO;
        
        
        return $secDao->checkRole($email);

    }
 
    //Returns array of users
    public function showTheUsers()
    {
        //Created to use DAO, then run function.
        $secDao = new SecurityDAO;
        
        
        return $secDao->showUsers();
        
    }
    
    public function findUserDetails(int $userID)
    {
        //Created to use DAO, then run function.
        $secDao = new SecurityDAO;
        
        
        return $secDao->getUserDetails($userID);
    }
    
    
}

