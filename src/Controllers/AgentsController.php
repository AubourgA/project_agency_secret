<?php

namespace App\Controllers;

use App\Models\AgentsModel;
use App\Security\checkAccess;

class AgentsController extends AbstractController

{
    public function index()
    {
        session_start();
        checkAccess::Check('home');
        $agent = new AgentsModel;
        $agents = $agent->findAll();

        return $this->render('admin\agents\agents', [
            'agents' => $agents
        ]);
    }

    public function create()
    {

        session_start();
        checkAccess::Check('home');

       if(isset($_POST['submit'])) {
        $nom = isset($_POST['name']) ? $_POST['name'] : "";
        $prenom = isset($_POST['name']) ? $_POST['prenom'] : "";
        $datebirth = isset($_POST['name']) ? $_POST['naissance'] : "";
        $typemission = isset($_POST['name']) ? $_POST['type'] : "";
        $code = isset($_POST['name']) ? $_POST['code'] : "";

        $datas = [
            'name' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $datebirth,
            'type_mission' => $typemission,
            'code' => $code,
            'specialite' => 'a choisir',
            'nationality' => "a choisir"
        ];

        $model = new AgentsModel;
        $agent = $model->hydrate($datas);
        $model->add($agent);

        
        
        header('Location: /admin');
       
       }
      

        return $this->render('admin\agents\createAgent', []);
    }

   public function delete(int $id)
   {
        session_start();
        checkAccess::Check('home');

        $deleteAgent = new AgentsModel;
        $deleteAgent->delete($id);
      
        header('Location: '.$_SERVER['HTTP_REFERER']);

   }

}