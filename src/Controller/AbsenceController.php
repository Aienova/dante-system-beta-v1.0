<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class AbsenceController extends AbstractController{


    public function absence(): Response {

        return $this->render("absence/index.html.twig",["controller_name" => "AbsenceController",]);

        
    }
    
}   

?>