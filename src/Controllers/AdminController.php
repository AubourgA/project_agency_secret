<?php

namespace App\Controllers;

use App\Models\AgentsModel;
use App\Models\ContactModel;
use App\Models\MissionModel;
use App\Models\PlanqueModel;
use App\Security\checkAccess;

class AdminController extends AbstractController
{
    public function index()
    {
       
        //Verification authorisation access
      session_start();
      checkAccess::Check('home');
     
      // recuperer tous les enregistrement de chaque table
      $agents = new AgentsModel;
      $NbAgent = count($agents->findAll());
      $contact = new ContactModel;
      $NbContact = count($contact->findAll());
      $Planque = new PlanqueModel;
      $NbPlanque = count($Planque->findAll());
      $mission = new MissionModel;
      $TotalMission = count($mission->findAll());
  

    
        return $this->render('admin/home', [
          'agents' => $NbAgent,
          'contact' => $NbContact,
          'planque' => $NbPlanque,
          'missions' => $TotalMission
        ]);
    }

    
}