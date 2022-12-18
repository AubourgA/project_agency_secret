<?php

namespace App\Controllers;


use App\Models\PlanqueModel;
use App\Security\checkAccess;

class PlanqueController extends AbstractController
{
    public function index()
    {
        session_start();
        checkAccess::Check('home');

        $planqueModel = new PlanqueModel;
        $planque = $planqueModel->findAll();

        return $this->render('admin\planque\planque', [
            'planque' => $planque
        ]);
    }

    /**
     * Creer un nouvel enregistrmeent
     *
     * @return void
     */
    public function create()
    {
        session_start();
        checkAccess::Check('home');

        if(isset($_POST['submit'])) {
            $adress =          isset($_POST['adress']) ? htmlspecialchars($_POST['adress']) : "";
            $country =       isset($_POST['country']) ? htmlspecialchars($_POST['country']) : "";
            $code =     isset($_POST['code']) ? htmlspecialchars($_POST['code']) : "";
            $type =         isset($_POST['type']) ? htmlspecialchars($_POST['type']) : "";
           
    
           $planque = new PlanqueModel;
    
           $planque->setAdress($adress)
                  ->setCountry($country)
                  ->setCode($code)
                  ->setType($type);
    
            $planque->add();
    
            $_SESSION['success'] = " Planque a bien été ajouté en base de donnee ";
            
            header('Location: /planque');
           }

        return $this->render('admin\planque\createPlanque', []);

    }

    /**
     * Delete recorder by id
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
         session_start();
         checkAccess::Check('home');
 
         $deletePlanque = new PlanqueModel;
         $deletePlanque->delete($id);
       
         header('Location: '.$_SERVER['HTTP_REFERER']);
 
    }

    /**
     * View a recorder and modify it
     *
     * @param integer $id
     * @return void
     */
    public function edit(int $id)
   {

    session_start();
    checkAccess::Check('home');

      //recuperer l'enregsitrement via l'id
      $planqueModel = new PlanqueModel;
      $planque = $planqueModel->findById($id);

      //verification si l'enregistrement existe
        if(!$planque) {
            header('Location: /admin');
            exit();
        }

    //si le formulaire a été envoyé pour modification
    if (isset($_POST['edit-planque'])) {

        $adress =          isset($_POST['adress']) ? htmlspecialchars($_POST['adress']) : "";
        $country =       isset($_POST['country']) ? htmlspecialchars($_POST['country']) : "";
        $code =     isset($_POST['code']) ? htmlspecialchars($_POST['code']) : "";
        $type =         isset($_POST['type']) ? htmlspecialchars($_POST['type']) : "";

        //creer un nouvell agent et inject dedans les valeur du formualire
        $planqueModif = new PlanqueModel;
        $planqueModif->setId($planque['Id'])
                    ->setAdress($adress)
                    ->setCountry($country)
                    ->setCode($code)
                    ->setType($type);
                

        //methode pour modfiier l'enregistrement
        $planqueModif->update();

        $_SESSION['success'] = " Enregistrement a bien été modifié en base de donnee ";
        header('Location: /planque');
       
    }
 
    return $this->render('admin\planque\editPlanque', [
        'planque' => $planque
    ]);
   }

}