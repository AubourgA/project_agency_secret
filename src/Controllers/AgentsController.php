<?php

namespace App\Controllers;

use App\Models\AgentsModel;
use App\Security\checkAccess;

class AgentsController extends AbstractController

{
    public function index(int $pages)
    {
        session_start();
        checkAccess::Check('home');

        $agent = new AgentsModel;
        $agents = $agent->findAll();

        //pagination
        
        $nbItems =count($agents);
       $nbitemInPage = 10;
       $totalPage = ceil($nbItems / $nbitemInPage);
       $fisrtitem = ($pages * $nbitemInPage) - $nbitemInPage;
       $agentPagination = new AgentsModel;
       $agentParPage = $agentPagination->pagination($fisrtitem);

    

        return $this->render('admin\agents\agents', [
            'agents' => $agentParPage,
            'nbPage' => $totalPage
        ]);
    }

    /**
     * Permet de creer un enregistrement
     *
     * @return void
     */
    public function create()
    {

        session_start();
        checkAccess::Check('home');

        if(isset($_POST['submit'])) {
            $nom =          isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
            $prenom =       isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : "";
            $datebirth =     isset($_POST['naissance']) ? htmlspecialchars($_POST['naissance']) : "";
            $code =         isset($_POST['code']) ? htmlspecialchars($_POST['code']) : "";
            $speciality =   isset($_POST['specialite']) ? htmlspecialchars($_POST['specialite']) : "";
            $nationality =  isset($_POST['nationality']) ? htmlspecialchars($_POST['nationality']) : "";

 
      
        
        $agent = new AgentsModel;

        $agent->setName($nom)
                ->setPrenom($prenom)
                ->setDate_naissance($datebirth)
                ->setCode($code)
                ->setSpecialite($speciality)
                ->setNationality($nationality);

        $agent->add();

        $_SESSION['success'] = " Agent a bien été ajouté en base de donnee ";

        header('Location: /agents/index/1');
       }
        return $this->render('admin\agents\createAgent', []);
    }

/**
 * Supprime un enregistrement
 *
 * @param integer $id
 * @return void
 */
   public function delete(int $id)
   {
        session_start();
        checkAccess::Check('home');

        $deleteAgent = new AgentsModel;
        $deleteAgent->delete($id);
      
        header('Location: '.$_SERVER['HTTP_REFERER']);

   }

   /**
    * Edit un enregistrement
    *
    * @param integer $id
    * @return void
    */
   public function edit(int $id)
   {

    session_start();
    checkAccess::Check('home');

    
        //recuperer l'enregsitrement via l'id
      $agentModel = new AgentsModel;
      $agent = $agentModel->findById($id);

      //verification si l'enregistrement existe
        if(!$agent) {
            header('Location: /admin');
            exit();
        }

    //si le formulaire a été envoyé pour modification
    if (isset($_POST['edit-agent'])) {

        $nom =          isset($_POST['Name']) ? htmlspecialchars($_POST['Name']) : "";
        $prenom =       isset($_POST['Prenom']) ? htmlspecialchars($_POST['Prenom']) : "";
        $datebirth =     isset($_POST['Date_naissance']) ? htmlspecialchars($_POST['Date_naissance']) : "";
        $code =         isset($_POST['Code']) ? htmlspecialchars($_POST['Code']) : "";
        $speciality =   isset($_POST['Specialite']) ? htmlspecialchars($_POST['Specialite']) : "";
        $nationality =  isset($_POST['Nationality']) ? htmlspecialchars($_POST['Nationality']) : "";

        //creer un nouvell agent et inject dedans les valeur du formualire
        $agentModif = new AgentsModel;
        $agentModif->setId($agent['Id'])
                    ->setName($nom)
                    ->setPrenom($prenom)
                    ->setDate_naissance($datebirth)
                    ->setSpecialite($speciality)
                    ->setCode($code)
                    ->setNationality($nationality);

        //methode pour modfiier l'enregistrement
        $agentModif->update();
       
        header('Location: /agents/');
       
    }
 
    
    return $this->render('admin\agents\editAgent', [
        'agent' => $agent
    ]);
   }

 

}