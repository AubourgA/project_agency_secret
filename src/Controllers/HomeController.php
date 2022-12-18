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


    /**
     * Visualiser les infos d'un enregistrement
     *
     * @param integer $id
     * @return void
     */
    public function edit(int $id)
    {

      $missions = new MissionModel;
      $mission = $missions->findById($id);

       //recupereration des id des liste
       $Agent_Name = $missions->findOneNameById('agents', 'Agent_Id', 'Id');
       $cible_Name = $missions->findOneNameById('cible', 'Cible_Id', 'Id');
       $Planque_Adress = $missions->findOneNameById('planque', 'Planque_Id', 'Id');
       $Contact_Name = $missions->findOneNameById('contact', 'Contact_Id','Id');

   
     
    
      return $this->render('edit', [
        'mission' => $mission,
        'Agent' => $Agent_Name,
        'Cible' => $cible_Name,
        'Planque' => $Planque_Adress,
        'Contact' => $Contact_Name

      ]);

    }

    public function search( $str)
    {
      $missionModel = new MissionModel;
     
       if(strlen($str) >= 3) {
        $resultat = $missionModel->findByString($str);
      } else {
         $resultat = $missionModel->findAll();

       }

    
     
       return $this->renderPart('search', [ 'res' => $resultat]);
    }



}