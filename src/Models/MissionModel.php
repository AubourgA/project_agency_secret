<?php

namespace App\Models;




class MissionModel extends Model
{

    protected int $Id;
    protected string $Title;
    protected string $Description;
    protected string $Status;
    protected $Date_debut;
    protected $Date_fin;
    protected $Type_mission;
    protected string $Code_name;
    protected int $Agent_Id;
    protected int $Cible_Id;
    protected int $Planque_Id;
    protected int $Contact_Id;

    public function __construct()
    {
        $this->table = 'missions';
    }

    
    public function findOneNameById($tab, $champs, $champs2) {
        $query = $this->requete("SELECT * 
                                FROM  {$this->table} 
                                JOIN $tab ON  {$this->table}.{$champs} = $tab.{$champs2}", []);
        return $query->fetch();
    }

    /**
     * Recherche mission par titre 
     *
     * @param [type] $str
     * @return void
     */
    public function findByString($str)
    {
        $query = $this->requete(" SELECT * FROM  $this->table WHERE Title LIKE  '%$str%'  ", []);
        return $query->fetchAll();
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
     * Get the value of Description
     */ 
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * Set the value of Description
     *
     * @return  self
     */ 
    public function setDescription($Description)
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * Get the value of Status
     */ 
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Set the value of Status
     *
     * @return  self
     */ 
    public function setStatus($Status)
    {
        $this->Status = $Status;

        return $this;
    }

    /**
     * Get the value of Date_debut
     */ 
    public function getDate_debut()
    {
        return $this->Date_debut;
    }

    /**
     * Set the value of Date_debut
     *
     * @return  self
     */ 
    public function setDate_debut($Date_debut)
    {
        $this->Date_debut = $Date_debut;

        return $this;
    }

    /**
     * Get the value of Date_fin
     */ 
    public function getDate_fin()
    {
        return $this->Date_fin;
    }

    /**
     * Set the value of Date_fin
     *
     * @return  self
     */ 
    public function setDate_fin($Date_fin)
    {
        $this->Date_fin = $Date_fin;

        return $this;
    }

    /**
     * Get the value of Code_name
     */ 
    public function getCode_name()
    {
        return $this->Code_name;
    }

    /**
     * Set the value of Code_name
     *
     * @return  self
     */ 
    public function setCode_name($Code_name)
    {
        $this->Code_name = $Code_name;

        return $this;
    }

    /**
     * Get the value of Agent_Id
     */ 
    public function getAgent_Id()
    {
        return $this->Agent_Id;
    }

    /**
     * Set the value of Agent_Id
     *
     * @return  self
     */ 
    public function setAgent_Id($Agent_Id)
    {
        $this->Agent_Id = $Agent_Id;

        return $this;
    }

    /**
     * Get the value of Cible_Id
     */ 
    public function getCible_Id()
    {
        return $this->Cible_Id;
    }

    /**
     * Set the value of Cible_Id
     *
     * @return  self
     */ 
    public function setCible_Id($Cible_Id)
    {
        $this->Cible_Id = $Cible_Id;

        return $this;
    }

    /**
     * Get the value of Planque_Id
     */ 
    public function getPlanque_Id()
    {
        return $this->Planque_Id;
    }

    /**
     * Set the value of Planque_Id
     *
     * @return  self
     */ 
    public function setPlanque_Id($Planque_Id)
    {
        $this->Planque_Id = $Planque_Id;

        return $this;
    }

    /**
     * Get the value of Contact_Id
     */ 
    public function getContact_Id()
    {
        return $this->Contact_Id;
    }

    /**
     * Set the value of Contact_Id
     *
     * @return  self
     */ 
    public function setContact_Id($Contact_Id)
    {
        $this->Contact_Id = $Contact_Id;

        return $this;
    }

    /**
     * Get the value of Title
     */ 
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * Set the value of Title
     *
     * @return  self
     */ 
    public function setTitle($Title)
    {
        $this->Title = $Title;

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
}