<?php

namespace App\Controllers;

use App\Models\CibleModel;
use App\Security\checkAccess;

class CibleController extends AbstractController
{
    public function index()
    {
        session_start();
        checkAccess::Check('home');

        $cible = new CibleModel;
        $cibles = $cible->findAll();

        return $this->render('admin\cible\cible', [
            'cibles' => $cibles
        ]);
    }

    /**
     * Creer un enregistrmeent
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
        $nationality =  isset($_POST['nationality']) ? htmlspecialchars($_POST['nationality']) : "";

       $cible = new CibleModel;

       $cible->setName($nom)
              ->setPrenom($prenom)
              ->setDate_naissance($datebirth)
              ->setCode($code)
              ->setNationality($nationality);

        $cible->add();

        $_SESSION['success'] = " Cible a bien été ajouté en base de donnee ";
        
        header('Location: /cible');
       }
        return $this->render('admin\cible\createCible', []);
    }

    /**
     * suprime un enregsitrement
     *
     * @param integer $id
     * @return void
     */
   public function delete(int $id)
   {
        session_start();
        checkAccess::Check('home');

        $deleteCible = new CibleModel;
        $deleteCible->delete($id);
      
        header('Location: '.$_SERVER['HTTP_REFERER']);

   }

   /**
    * Edit un enregistrement et le modifie
    *
    * @param integer $id
    * @return void
    */
   public function edit(int $id)
   {

    session_start();
    checkAccess::Check('home');

      //recuperer l'enregsitrement via l'id
      $cibleModel = new CibleModel;
      $cible = $cibleModel->findById($id);

      //verification si l'enregistrement existe
        if(!$cible) {
            header('Location: /admin');
            exit();
        }

    //si le formulaire a été envoyé pour modification
    if (isset($_POST['edit-cible'])) {

        $nom =          isset($_POST['Name']) ? htmlspecialchars($_POST['Name']) : "";
        $prenom =       isset($_POST['Prenom']) ? htmlspecialchars($_POST['Prenom']) : "";
        $datebirth =     isset($_POST['Date_naissance']) ? htmlspecialchars($_POST['Date_naissance']) : "";
        $code =         isset($_POST['Code']) ? htmlspecialchars($_POST['Code']) : "";
        $nationality =  isset($_POST['Nationality']) ? htmlspecialchars($_POST['Nationality']) : "";

        //creer un nouvell agent et inject dedans les valeur du formualire
        $cibleModif = new CibleModel;
        $cibleModif->setId($cible['Id'])
                    ->setName($nom)
                    ->setPrenom($prenom)
                    ->setDate_naissance($datebirth)
                    ->setCode($code)
                    ->setNationality($nationality);

        //methode pour modfiier l'enregistrement
        $cibleModif->update();
       
        header('Location: /cible/');
       
    }
 
 
    
    return $this->render('admin\cible\editCible', [
        'cible' => $cible
    ]);
   }


}