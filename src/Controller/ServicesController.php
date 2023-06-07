<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class ServicesController extends AbstractController{

    public function services(): Response {

        return $this->render("services/index.html.twig",["controller_name" => "ServicesController",]);
        
    }
    
    
}   

?>