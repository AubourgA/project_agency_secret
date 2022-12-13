<?php

namespace App\Models;

use DB\database;



class Model extends database
{
    protected $table;

    private $db;


    public function findAll()
    {
        $query = $this->requete(' SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

 public function find(string $email)
 {
    $query = $this->requete("SELECT * FROM  {$this->table} WHERE email = ?", [$email]);
    return $query->fetch();
 }
  

    
    public function requete(string $sql, array $attributs = null)
    {
        $this->db = database::getInstance();

        if($attributs !== null) {
            $query = $this->db->prepare($sql);
             $query->execute($attributs);
                
            return $query;
        } else {
            return $this->db->query($sql);
        }
    }

}