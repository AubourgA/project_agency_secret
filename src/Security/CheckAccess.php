<?php

namespace App\Security;

class checkAccess
{

    public static function Check(string $path){

        
        if(!isset($_SESSION['user'])) {
            header('Location: /'. $path);
          }
    }

}