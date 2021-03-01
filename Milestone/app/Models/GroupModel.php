<?php

namespace App\Models;

class GroupModel
{
    private $groupName; //GroupName
    private $id;        //Id of user in group
    private $userName;  //Name of user in the group
    private $summary;   //Summary in group.
    private $creatorId;
    
    
    //Constructor
    public function __construct($groupName, $id, $userName, $summary, $creatorId)
    {
        
        $this->groupName = $groupName;
        $this->id = $id;
        $this->userName = $userName;
        $this->summary = $summary;
        $this->creatorId = $creatorId;
        
    }
    
    /**
     * @return mixed
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $groupName
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }
    
    /**
     * @param mixed $creatorIdid
     */
    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;
    }

    /**
     * @return mixed
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    
    
    
}