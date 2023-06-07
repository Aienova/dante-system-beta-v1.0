<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class StatController extends AbstractController{


    public function stat(): Response {

        return $this->render("stat/index.html.twig",["controller_name" => "StatController",]);
        
    }
    
    
}   

?>