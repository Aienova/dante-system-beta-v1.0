<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class SpecificationsController extends AbstractController{


    public function specifications(): Response {

        return $this->render("specifications/index.html.twig",["controller_name" => "SpecificationsController",]);
        
    }
    
    
}   

?>