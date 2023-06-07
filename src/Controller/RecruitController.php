<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class RecruitController extends AbstractController{


    public function recruit(): Response {

        return $this->render("recruit/index.html.twig",["controller_name" => "RecruitController",]);

        
    }
    
    
}   

?>