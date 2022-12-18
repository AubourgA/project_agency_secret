<?php

namespace App\Controllers;

use App\Models\CibleModel;
use App\Models\AgentsModel;
use App\Models\ContactModel;
use App\Models\MissionModel;
use App\Models\PlanqueModel;
use App\Security\checkAccess;

class MissionController extends AbstractController
{
    /**
     * Affiche liste des missions
     *
     * @return void
     */
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

    /**
     * creer enregistrement
     *
     * @return void
     */
    public function create()
    {
        session_start();
        checkAccess::Check('home');

        //Recuperer les info pour les listes de choix
        $agent = new AgentsModel;
        $agents = $agent->findAll();

        $contact = new ContactModel;
        $contacts = $contact->findAll();

        $cible = new CibleModel;
        $cibles = $cible->findAll();

        $planque = new PlanqueModel;
        $planques = $planque->findAll();
       
     

        //verifie si formulaire a été envoyé
        if(isset($_POST['submit'])) {
            $titre =          isset($_POST['Title']) ? htmlspecialchars($_POST['Title']) : "";
            $description =       isset($_POST['Description']) ? htmlspecialchars($_POST['Description']) : "";
            $status =     isset($_POST['Status']) ? htmlspecialchars($_POST['Status']) : "";
            $dateDebut =     isset($_POST['date_debut']) ? htmlspecialchars($_POST['date_debut']) : "";
            $dateFin =     isset($_POST['date_fin']) ? htmlspecialchars($_POST['date_fin']) : "";

            $TypeMission =  isset($_POST['Type_mission']) ? htmlspecialchars($_POST['Type_mission']) : "";
            $code =         isset($_POST['Code_name']) ? htmlspecialchars($_POST['Code_name']) : "";
            $agent_id = isset($_POST['Agent']) ? (int) htmlspecialchars($_POST['Agent']) : "";
            $cible_id = isset($_POST['Cible']) ? (int) htmlspecialchars($_POST['Cible']) : "";
            $planque_id = isset($_POST['Planque']) ? (int) htmlspecialchars($_POST['Planque']) : "";
            $contact_id = isset($_POST['Contact']) ? (int) htmlspecialchars($_POST['Contact']) : "";

            //hydrate le model
            $mission = new MissionModel;
            $mission->setTitle($titre)
                    ->setDescription($description)
                    ->setStatus($status)
                    ->setDate_debut($dateDebut)
                    ->setDate_fin($dateFin)
                    ->setType_mission($TypeMission)
                    ->setCode_name($code)
                    ->setAgent_Id($agent_id)
                    ->setCible_Id($cible_id)
                    ->setPlanque_Id($planque_id)
                    ->setContact_Id($contact_id);
     
                    //ajoute en bdd
            $mission->add();

            header('Location: /mission');

        }
        return $this->render('admin\mission\createMission', [
            'agents' => $agents,
            'contacts' => $contacts,
            'planques' => $planques,
            'cibles' => $cibles
        ]);
    }

    /**
     * supprime enregistrement
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
         session_start();
         checkAccess::Check('home');
 
         $deleteMission = new MissionModel;
         $deleteMission->delete($id);
       
         header('Location: '.$_SERVER['HTTP_REFERER']);
 
    }

    /**
     * Edit et modifie un enregistrement
     *
     * @param integer $id
     * @return void
     */
    public function edit(int $id)
    {
        session_start();
        checkAccess::Check('home');

          //recuperer l'enregsitrement via l'id
      $missionModel = new MissionModel;
      $mission = $missionModel->findById($id);

        //verification si l'enregistrement existe
        if(!$mission) {
            header('Location: /admin');
            exit();
        }

      //recupereration des id des liste
      $Agent_Name = $missionModel->findOneNameById('agents', 'Agent_Id', 'Id')['Name'];
      $cible_Name = $missionModel->findOneNameById('cible', 'Cible_Id', 'Id')['Name'];
      $Planque_Adress = $missionModel->findOneNameById('planque', 'Planque_Id', 'Id')['Adress'];
      $Contact_Name = $missionModel->findOneNameById('contact', 'Contact_Id','Id')['Name'];
      


         //Recuperer les info pour les listes de choix
         $agent = new AgentsModel;
         $agents = $agent->findAll();
       
         $contact = new ContactModel;
         $contacts = $contact->findAll();
 
         $cible = new CibleModel;
         $cibles = $cible->findAll();
 
         $planque = new PlanqueModel;
         $planques = $planque->findAll();


       
         //si le formulaire a été envoépour modfification
         if (isset($_POST['submit']) ) {
            $titre =          isset($_POST['Title']) ? htmlspecialchars($_POST['Title']) : "";
            $description =       isset($_POST['Description']) ? htmlspecialchars($_POST['Description']) : "";
            $status =     isset($_POST['Status']) ? htmlspecialchars($_POST['Status']) : "";
            $dateDebut =     isset($_POST['date_debut']) ? htmlspecialchars($_POST['date_debut']) : "";
            $dateFin =     isset($_POST['date_fin']) ? htmlspecialchars($_POST['date_fin']) : "";

            $TypeMission =  isset($_POST['Type_mission']) ? htmlspecialchars($_POST['Type_mission']) : "";
            $code =         isset($_POST['Code_name']) ? htmlspecialchars($_POST['Code_name']) : "";
            $agent_id = isset($_POST['Agent']) ? (int) htmlspecialchars($_POST['Agent']) : "";
            $cible_id = isset($_POST['Cible']) ? (int) htmlspecialchars($_POST['Cible']) : "";
            $planque_id = isset($_POST['Planque']) ? (int) htmlspecialchars($_POST['Planque']) : "";
            $contact_id = isset($_POST['Contact']) ? (int) htmlspecialchars($_POST['Contact']) : "";

            $missionModif = new MissionModel;
            $missionModif->setId($mission['Id'])
                        ->setTitle($titre)
                        ->setDescription($description)
                        ->setStatus($status)
                        ->setDate_debut($dateDebut)
                        ->setDate_fin($dateFin)
                        ->setType_mission($TypeMission)
                        ->setCode_name($code)
                        ->setAgent_Id($agent_id)
                        ->setCible_Id($cible_id)
                        ->setPlanque_Id($planque_id)
                        ->setContact_Id($contact_id);

            //met a jour l'enregistrement
            $missionModif->update();
            header('Location: /mission');
         }
      

      return $this->render('admin\mission\editMission', [
        'mission' => $mission,
        'agents' => $agents,
        'contacts' => $contacts,
        'planques' => $planques,
        'cibles' => $cibles,
        'Agent_Name' => $Agent_Name,
        'cible_Name' => $cible_Name,
        'Planque_Adress' => $Planque_Adress,
        'Contact_Name' => $Contact_Name

      ]);
    }
}