<?php

namespace App\Controllers;

use App\Security\checkAccess;

class AgentsController extends AbstractController

{
    public function index()
    {
        session_start();
        checkAccess::Check('home');
   
        return $this->render('admin\agents', []);
    }

    public function create()
    {

        session_start();
        checkAccess::Check('home');

        return $this->render('admin\createAgent', []);
    }

   
}