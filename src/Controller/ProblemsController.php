<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class ProblemsController extends AbstractController{

    public function problems(): Response {

        return $this->render("problems/index.html.twig",["controller_name" => "ProblemsController",]);

        
    }
    
}   

?>