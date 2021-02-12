<?php
namespace App\Services\Business;


use App\Services\Data\SecurityDAO;

//Bussiness class that runs the function from the DAO
class SecurityService
{
    //Suspends a user that is put in.
    public function suspendUser(string $name)
    {
        //Created to use DAO, then run function.
        $secDao = new SecurityDAO;
        $secDao->addSuspendedUser($name);
        
    }
    
    //Suspends a user that is put in.
    public function userToAdmin(string $name)
    {
        //Created to use DAO, then run function.
        $secDao = new SecurityDAO;
        $secDao->addAdmin($name);
        
    }
    
    
    
    //Suspends a user that is put in.
    public function suspendUserPerm(string $name)
    {
        //Created to use DAO, then run function.
        $secDao = new SecurityDAO;
        $secDao->permSuspendUser($name);
        
    }
    
    //checks if user is suspended
    public function checkWhatRole(string $email)
    {
        //Created to use DAO, then run function.
        $secDao = new SecurityDAO;
        
        
        return $secDao->checkRole($email);

    }
    
    
    
}

