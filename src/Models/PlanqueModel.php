<?php

namespace App\Models;

class PlanqueModel extends Model
{
    protected int $Id;
    protected string $Adress;
    protected string $Country;
    protected int $Code;
    protected string $Type;
   

    public function __construct()
    {
        $this->table = 'planque';
    }

    
    

    /**
     * Get the value of Id
     */ 
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Set the value of Id
     *
     * @return  self
     */ 
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }

    /**
     * Get the value of Adress
     */ 
    public function getAdress()
    {
        return $this->Adress;
    }

    /**
     * Set the value of Adress
     *
     * @return  self
     */ 
    public function setAdress($Adress)
    {
        $this->Adress = $Adress;

        return $this;
    }

    /**
     * Get the value of Country
     */ 
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * Set the value of Country
     *
     * @return  self
     */ 
    public function setCountry($Country)
    {
        $this->Country = $Country;

        return $this;
    }

    /**
     * Get the value of Code
     */ 
    public function getCode()
    {
        return $this->Code;
    }

    /**
     * Set the value of Code
     *
     * @return  self
     */ 
    public function setCode($Code)
    {
        $this->Code = $Code;

        return $this;
    }

    /**
     * Get the value of Type
     */ 
    public function getType()
    {
        return $this->Type;
    }

    /**
     * Set the value of Type
     *
     * @return  self
     */ 
    public function setType($Type)
    {
        $this->Type = $Type;

        return $this;
    }
}