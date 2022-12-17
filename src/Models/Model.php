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


    public function findBy(array $params)
    {
        $props = [];
        $values = [];

        foreach($params as $prop => $value) {
            $props[] = "$prop = ?";
            $values[] = $value;
        }

        $liste_props = implode(' AND ', $props);

        return $this->requete('SELECT * FROM ' . $this->table . ' WHERE ' . $liste_props, $values)->fetchAll();
    }

    public function find(string $email)
    {
        $query = $this->requete("SELECT * FROM  {$this->table} WHERE email = ?", [$email]);
        return $query->fetch();
    }
  
    public function findById(int $id)
    {
        $query = $this->requete("SELECT * FROM  {$this->table} WHERE id = ?", [$id]);
        return $query->fetch();
    }

    public function add()
    {
        $props = [];
        $values = [];
        $caractere = [];

        foreach($this as $prop => $value) {
            if( $value !== null && $prop !== 'db' && $prop !== 'table') {

                $props[] = $prop;
                $caractere[] = "?";
                $values[] = $value;
            }
        }

        $liste_props = implode(',', $props);
        $liste_carac = implode(',', $caractere);
   
        return $this->requete('INSERT INTO ' . $this->table . '  (' . $liste_props . ') VALUES ( '.$liste_carac. ' )', $values);
    }

    public function update()
    {
        $props = [];
        $values = [];

        foreach($this as $prop => $value) {
            if($value !== null && $prop !== 'db' && $prop !== 'table') {
                $props[] = "$prop = ?";
                $values[] = $value;
            }
        }

        $values[] = $this->Id;
       
        $list_props = implode(',', $props);
        
        return $this->requete('UPDATE '.$this->table.' SET '. $list_props.' WHERE Id = ?', $values);
        
    }


    public function delete(int $id)
    {
        return $this->requete('DELETE FROM ' . $this->table.  ' WHERE id = ?', [$id]);
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

    public function hydrate($datas)
    {
        foreach($datas as $key => $value) {
            //nom d setter
            $setter = 'set'.ucfirst($key);
            //on check si setter existe
            if(method_exists($this, $setter)) {
                //si oui 
                $this->$setter($value);
            }
        }
        return $this;
    }

}