<?php
namespace App\Controllers;

abstract class AbstractController
{
    /**
     * Permet d'afficher la vue
     *
     * @param string $file
     * @param array $datas
     * @return void
     */
    public function render(string $file, $datas = [])
    {
        //ectraction des datas
         extract($datas);

        
        //demarre le buffer de sortie - conserve en memoire
         ob_start();
        

         //fichier a inclurre
         require_once  ROOT. '/src/templates/'.$file.'.phtml';
         //stop le buffer et le stock dans la varaiable
         $contenu = ob_get_clean(); 

         //mettre contenu dans le fichier de base
         require_once  ROOT . '/src/templates/layout.phtml';
    }

   

    

    
}