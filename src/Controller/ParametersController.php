<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class ParametersController extends AbstractController{


    public function parameters(): Response {

        return $this->render("parameters/index.html.twig",["controller_name" => "ParametersController",]);

        
    }
    
}   

?>