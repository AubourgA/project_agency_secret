<?php

namespace App\Controllers;

use App\Models\AdminModel;

class LoginController extends AbstractController
{
    

    public function index()
    {
        session_start();

        //generation d'un token se sécurité pour le formulaire
        $_SESSION['login_token'] = bin2hex(openssl_random_pseudo_bytes(32)); ;
       

        return $this->render('login', []);
    }
    
    public function authentification()
    {
        session_start();
        
        //verification du token de securite
        $token = htmlspecialchars($_POST['token']);

        
        //verification si envois formulaire
        if (isset($_POST['submit']) && $_SESSION['login_token'] === $token) {
            
            
            //verification presssence des info connexion
            if( isset($_POST['email'], $_POST['password']) && !empty($_POST['email'] && !empty($_POST['password']))) {
                
                //verification type de donnée
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    header('Location: /index.php');
                }
                
                //protection faille xss
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                
                //Recuperation email est dans la base de donée
                $admin = new AdminModel();
                
                $response = $admin->find($email);
                
                //verificaton existance mail dans BDD
                if (!$response) {
                    header('Location: /home');
                    die();
                }
                
                if (isset($response)) {
                    //test password et celui en BDD
                 
                    if (password_verify($password, $response['password'])) {
                         
                        
                       session_start();
                        $_SESSION['user'] =  [
                            'name' => $response['name']
                        ];
                        var_dump(session_status());
                        header('Location: /admin');
                        die();
                    } else {
                        header('Location: /login');
                    }
               } 
        
            }
          
        }
        header('Location: /home');
    } 

    public function logout()
    {
       
       session_start();
       unset($_SESSION['user']);
       session_destroy();
  
       return header('Location: /home');
      
        
    }
}