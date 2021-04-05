<?php
namespace App\Services\Business;


use App\Models\GroupModel;
use App\Services\Data\GroupDAO;
use Illuminate\Http\Request;

//Bussiness class that runs the functions from the DAO for the Job
class GroupService
{
    
    //Joins a group
    public function joinAGroup(GroupModel $groupData)
    {
        $groServ = new GroupDAO;
        
        return $groServ->joinGroup($groupData);
    }
    
    //Leaves a group
    public function leaveAGroup(GroupModel $groupData)
    {
        $groServ = new GroupDAO;
        
        return $groServ->leaveGroup($groupData);
    }
    
    //Deletes users and group makers
    public function deleteAllGroup(int $id)
    {
        $groServ = new GroupDAO;
        
        return $groServ->DeleteAllGroups($id);
    }
    
    //Admin Deletes a group
    public function deleteAGroup(string $groupName, int $groupId)
    {
        $groServ = new GroupDAO;
        
        return $groServ->deleteGroup($groupName, $groupId);
    }
    
    
    //Show users in a group
    public function showGroupUsers(string $groupName)
    {
        $groServ = new GroupDAO;
        
        return $groServ->groupsUsers($groupName);
    }
    
    //Show all groups
    public function showAllGroups()
    {
        $groServ = new GroupDAO;
        
        return $groServ->allGroups();
    }
    
    
    //Add a Group
    public function addAGroup(GroupModel $groupData)
    {
        $groServ = new GroupDAO;
        
        return $groServ->addGroup($groupData);
    }
    
    //Update a Group
    public function updateAGroup(GroupModel $groupData, string $compare)
    {
        $groServ = new GroupDAO;
        
        return $groServ->updateGroup($groupData, $compare);
    }
    
    
    //Checks if user is in group
    public function checkGroupe (string $groupName, int $userId)
    {
        $groServ = new GroupDAO;
        
        $users = $groServ->groupsUsers($groupName);
        
        
        for($x = 0; $x < count($users); $x++)
        {
            if($users[$x]->getId() == $userId)
            {
                return true;
            }
            
        }
           return false; 
    }
    
    //Validation Rules to be returned
    public function validateGroup(Request $request)
    {
        //setup Data Validation Rules for Login Form
        $rules = [
            'groupName' => 'Required | Between: 2, 80',
            
            'summary' => 'Required | Between: 5, 1000',
        ];
        
        return $rules;
        
    }
}

