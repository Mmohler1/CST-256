<?php

namespace App\Models;

class ApplyModel
{
    private $applyId; //individual id for apply
    private $jobId;        //Id of job
    private $id;  //Id matching the user applying
    private $email;   //users email
    private $name; //Users name

    
    //Constructor
    public function __construct($applyId, $jobId, $id, $email, $name)
    {
        
        $this->applyId = $applyId;
        $this->jobId = $jobId;
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        
    }
    
    
    /**
     * @return mixed
     */
    public function getApplyId()
    {
        return $this->applyId;
    }

    /**
     * @return mixed
     */
    public function getJobId()
    {
        return $this->jobId;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $applyId
     */
    public function setApplyId($applyId)
    {
        $this->applyId = $applyId;
    }

    /**
     * @param mixed $jobId
     */
    public function setJobId($jobId)
    {
        $this->jobId = $jobId;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    
   
    
}