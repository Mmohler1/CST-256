<?php
namespace App\Services\Business;


use App\Models\UserModel;
use App\Services\Data\SecurityDAO;

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
}

