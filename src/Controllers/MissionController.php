<?php

namespace App\Controllers;

use App\Models\MissionModel;
use App\Security\checkAccess;

class MissionController extends AbstractController
{
    public function index()
    {
        session_start();
        checkAccess::Check('home');

        $missionModel = new MissionModel;
        $mission = $missionModel->findAll();

        return $this->render('/admin/mission/mission', [
            'mission' => $mission
        ]); 
    }
}