<?php

namespace DB;

use PDO;
use PDOException;

class database extends PDO
{
 
    private static $instance;

    private const HOST = 'localhost';
    private const USER = 'root';
    private const PASS = 'root';
    private const NAME = 'monagence';

    private function __construct()
    {
        $dsn =  "mysql:dbname=". self::NAME . ';host=' . self::HOST;

        try {
            parent::__construct($dsn, self::USER, self::PASS);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            die($e->getMessage());
        }

    }

    public static function getInstance():self
    {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}