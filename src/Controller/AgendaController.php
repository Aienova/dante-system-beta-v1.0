<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class AgendaController extends AbstractController{


    public function agenda(): Response {

        return $this->render("agenda/index.html.twig",["controller_name" => "AgendaController",]);

        
    }
    
    
}   

?>