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

       if(isset($_POST['submit'])) {
        $nom =          isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
        $prenom =       isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : "";
        $datebirth =     isset($_POST['naissance']) ? htmlspecialchars($_POST['naissance']) : "";
        $code =         isset($_POST['code']) ? htmlspecialchars($_POST['code']) : "";
        $nationality =  isset($_POST['nationality']) ? htmlspecialchars($_POST['nationality']) : "";

       $contact = new ContactModel;

       $contact->setName($nom)
              ->setPrenom($prenom)
              ->setDate_naissance($datebirth)
              ->setCode($code)
              ->setNationality($nationality);

        $contact->add();

        $_SESSION['success'] = " Contact a bien été ajouté en base de donnee ";
        
        header('Location: /contact');
       }
        return $this->render('admin\contact\createContact', []);
    }


   public function delete(int $id)
   {
        session_start();
        checkAccess::Check('home');

        $deleteContact = new contactModel;
        $deleteContact->delete($id);
      
        header('Location: '.$_SERVER['HTTP_REFERER']);

   }

   public function edit(int $id)
   {

    session_start();
    checkAccess::Check('home');

      //recuperer l'enregsitrement via l'id
      $contactModel = new ContactModel;
      $contact = $contactModel->findById($id);

      //verification si l'enregistrement existe
        if(!$contact) {
            header('Location: /admin');
            exit();
        }

    //si le formulaire a été envoyé pour modification
    if (isset($_POST['edit-contact'])) {

        $nom =          isset($_POST['Name']) ? htmlspecialchars($_POST['Name']) : "";
        $prenom =       isset($_POST['Prenom']) ? htmlspecialchars($_POST['Prenom']) : "";
        $datebirth =     isset($_POST['Date_naissance']) ? htmlspecialchars($_POST['Date_naissance']) : "";
        $code =         isset($_POST['Code']) ? htmlspecialchars($_POST['Code']) : "";
        $nationality =  isset($_POST['Nationality']) ? htmlspecialchars($_POST['Nationality']) : "";

        //creer un nouvell agent et inject dedans les valeur du formualire
        $contactModif = new ContactModel;
        $contactModif->setId($contact['Id'])
                    ->setName($nom)
                    ->setPrenom($prenom)
                    ->setDate_naissance($datebirth)
                    ->setCode($code)
                    ->setNationality($nationality);

        //methode pour modfiier l'enregistrement
        $contactModif->update();
       
        header('Location: /contact/');
       
    }
 
 
    
    return $this->render('admin\contact\editContact', [
        'contact' => $contact
    ]);
   }

}