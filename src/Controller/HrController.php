<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class HrController extends AbstractController{

    public function hr(): Response {

        return $this->render("hr/index.html.twig",["controller_name" => "HrController",]);

        
    }
    
    
}   

?>