<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class InstituteController extends AbstractController{

    

    public function institute(): Response {

        return $this->render("institute/index.html.twig",["controller_name" => "instituteController",]);

        
    }
    
    
}   

?>