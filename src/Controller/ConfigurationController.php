<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class ConfigurationController extends AbstractController{


    public function configuration(): Response {

        return $this->render("configuration/index.html.twig",["controller_name" => "ConfigurationController",]);

        
    }
    
}   

?>