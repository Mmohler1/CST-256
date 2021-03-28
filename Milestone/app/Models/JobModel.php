<?php

namespace App\Models;

use JsonSerializable;

class JobModel implements \JsonSerializable
{
    private $id;
    private $name;
    private $requirement;
    private $summary;
    private $jobid;
    
    
    
    //Constructor
    public function __construct($id, $name, $requirement, $summary, $jobid)
    {
        $this->id = $id;
        $this->name = $name;
        $this->requirement = $requirement;
        $this->summary = $summary;
        $this->jobid = $jobid;
    }
    
    
    /**
     * {@inheritDoc}
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize()
    {
        // TODO Auto-generated method stub
        return get_object_vars($this);
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
    public function getJobId()
    {
        return $this->jobid;
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getRequirement()
    {
        return $this->requirement;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @param mixed $id
     */
    public function setJobId($jobid)
    {
        $this->jobid = $jobid;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $requirement
     */
    public function setRequirement($requirement)
    {
        $this->requirement = $requirement;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }
   
    
}