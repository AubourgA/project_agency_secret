<?php

namespace App\Controllers;

use App\Security\checkAccess;

class AdminController extends AbstractController
{
    public function index()
    {
       
        //Verification authorisation access
      session_start();
      checkAccess::Check('home');
     
    

    
        return $this->render('admin/home', []);
    }

    
}