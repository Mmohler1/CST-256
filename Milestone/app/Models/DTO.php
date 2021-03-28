<?php
namespace App\Models;

class DTO implements \JsonSerializable
{
    private $errorCode;
    private $errorMessage;
    private $data;

    
    

    public function __construct($errorCode, $errorMessage, $data)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->data = $data;    
    }
    
    public function jsonSerialize()
    {
        
        return get_object_vars($this);
    }
    
    
    
    
    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }
    
    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
    
    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * @param string $errorCode
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }
    
    /**
     * @param string $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }
    
    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}

