<?php

namespace App\Controllers;

use App\Models\MissionModel;
use App\Controllers\AbstractController;


class HomeController extends AbstractController
{

  
    public function index()
    {
      

   $mission = new MissionModel;
   
   $missions = $mission->findAll();
  

      return $this->render('home', ['missions' => $missions]);
    }

    public function edit(int $id)
    {

      $id = $id;
      return $this->render('edit', ['id' => $id]);

    }


}