<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class MainformationController extends AbstractController{

    public function mainformation(): Response {

        return $this->render("mainformation/index.html.twig",["controller_name" => "MainformationController",]);
        
    }
    
    
}   

?>