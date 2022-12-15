<?php

namespace App\Controllers;

use App\Models\ContactModel;
use App\Security\checkAccess;

class ContactController extends AbstractController

{
    public function index()
    {
        session_start();
        checkAccess::Check('home');

        $contact = new ContactModel;
        $contacts = $contact->findAll();

        return $this->render('admin\contact\contact', [
            'agents' => $contacts
        ]);
    }

    public function create()
    {

        session_start();
        checkAccess::Check('home');

//        if(isset($_POST['submit'])) {
//         $nom =          isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
//         $prenom =       isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : "";
//         $datebirth =     isset($_POST['naissance']) ? htmlspecialchars($_POST['naissance']) : "";
//         $typemission =  isset($_POST['type']) ? htmlspecialchars($_POST['type']) : "";
//         $code =         isset($_POST['code']) ? htmlspecialchars($_POST['code']) : "";
//         $speciality =   isset($_POST['specialite']) ? htmlspecialchars($_POST['specialite']) : "";
//         $nationality =  isset($_POST['nationality']) ? htmlspecialchars($_POST['nationality']) : "";

//         $datas = [
//             'name' => $nom,
//             'prenom' => $prenom,
//             'date_naissance' => $datebirth,
//             'type_mission' => $typemission,
//             'code' => $code,
//             'specialite' => $speciality,
//             'nationality' => $nationality
//         ];

//         $model = new AgentsModel;
//         $agent = $model->hydrate($datas);
//         $model->add($agent);
        
//         header('Location: /admin');
//        }
        return $this->render('admin\contact\createContact', []);
    }


//    public function delete(int $id)
//    {
//         session_start();
//         checkAccess::Check('home');

//         $deleteAgent = new AgentsModel;
//         $deleteAgent->delete($id);
      
//         header('Location: '.$_SERVER['HTTP_REFERER']);

//    }

//    public function edit(int $id)
//    {

//     session_start();
//     checkAccess::Check('home');

//     $model = new AgentsModel;
//     $agent = $model->findById($id);


//     //si le formulaire a été envoyé pour modification
//     if (isset($_POST['edit-agent'])) {

//         $nom =          isset($_POST['Name']) ? htmlspecialchars($_POST['Name']) : "";
//         $prenom =       isset($_POST['Prenom']) ? htmlspecialchars($_POST['Prenom']) : "";
//         $datebirth =     isset($_POST['Date_naissance']) ? htmlspecialchars($_POST['Date_naissance']) : "";
//         $typemission =  isset($_POST['Type_mission']) ? htmlspecialchars($_POST['Type_mission']) : "";
//         $code =         isset($_POST['Code']) ? htmlspecialchars($_POST['Code']) : "";
//         $speciality =   isset($_POST['Specialite']) ? htmlspecialchars($_POST['Specialite']) : "";
//         $nationality =  isset($_POST['Nationality']) ? htmlspecialchars($_POST['Nationality']) : "";

//         $datas = [
//             'name' => $nom,
//             'prenom' => $prenom,
//             'date_naissance' => $datebirth,
//             'type_mission' => $typemission,
//             'code' => $code,
//             'specialite' => $speciality,
//             'nationality' => $nationality
//         ];

 

//        $update_agent = $model->hydrate($datas);
//        $model->update($id, $update_agent);
       
//         header('Location: /agents/');
       
//     }
 
    
//     return $this->render('admin\agents\editAgent', [
//         'agent' => $agent
//     ]);
//    }

}