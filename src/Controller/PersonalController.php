<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class PersonalController extends AbstractController{


    public function personal(): Response {

        return $this->render("personal/index.html.twig",["controller_name" => "PersonalController",]);

        
    }
    
    
}   

?>