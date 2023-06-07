<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;




class FormationController extends AbstractController{


    public function formation(): Response {

        return $this->render("formation/index.html.twig",["controller_name" => "FormationController",]);

    }
    
}   

?>