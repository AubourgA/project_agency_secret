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

    public function edit(int $id)
    {

      $id = $id;
      return $this->render('edit', ['id' => $id]);

    }


}