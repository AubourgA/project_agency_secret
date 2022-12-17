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
    
            $_SESSION['success'] = " Contact a bien été ajouté en base de donnee ";
            
            header('Location: /planque');
           }
            return $this->render('admin\planque\createPlanque', []);

    }
}