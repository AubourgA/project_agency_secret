<?php

namespace App\Controllers;



use App\Models\AdminModel;
use App\Controllers\AbstractController;


class HomeController extends AbstractController
{

  
    public function index()
    {
       

    $users = new AdminModel;
    $response = $users->findAll();
     

      return $this->render('home', ['response' => $response]);
    }



}