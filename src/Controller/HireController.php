<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class HireController extends AbstractController{

    public function hire(): Response {

        return $this->render("hire/index.html.twig",["controller_name" => "HireController",]);

        
    }
    
}   

?>