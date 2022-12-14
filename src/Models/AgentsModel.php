<?php

namespace App\Models;

class AgentsModel extends Model
{

    protected $Id;
    protected $Specialite;
    protected $Name;
    protected $Prenom;
    protected $Date_naissance;
    protected $Type_mission;
    protected $Code;
    protected $Nationality;

    public function __construct()
    {
        $this->table = 'agents';
        
    }

    

    /**
     * Get the value of Nationality
     */ 
    public function getNationality()
    {
        return $this->Nationality;
    }

    /**
     * Set the value of Nationality
     *
     * @return  self
     */ 
    public function setNationality($Nationality)
    {
        $this->Nationality = $Nationality;

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
     * Get the value of Type_mission
     */ 
    public function getType_mission()
    {
        return $this->Type_mission;
    }

    /**
     * Set the value of Type_mission
     *
     * @return  self
     */ 
    public function setType_mission($Type_mission)
    {
        $this->Type_mission = $Type_mission;

        return $this;
    }

    /**
     * Get the value of Date_naissance
     */ 
    public function getDate_naissance()
    {
        return $this->Date_naissance;
    }

    /**
     * Set the value of Date_naissance
     *
     * @return  self
     */ 
    public function setDate_naissance($Date_naissance)
    {
        $this->Date_naissance = $Date_naissance;

        return $this;
    }

    /**
     * Get the value of Prenom
     */ 
    public function getPrenom()
    {
        return $this->Prenom;
    }

    /**
     * Set the value of Prenom
     *
     * @return  self
     */ 
    public function setPrenom($Prenom)
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    /**
     * Get the value of Name
     */ 
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setName($Name)
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * Get the value of Specialite
     */ 
    public function getSpecialite()
    {
        return $this->Specialite;
    }

    /**
     * Set the value of Specialite
     *
     * @return  self
     */ 
    public function setSpecialite($Specialite)
    {
        $this->Specialite = $Specialite;

        return $this;
    }

    /**
     * Get the value of Id
     */ 
    public function getId()
    {
        return $this->Id;
    }
}