<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class MaintaskController extends AbstractController{

    public function maintask(): Response {

        return $this->render("maintask/index.html.twig",["controller_name" => "MaintaskController",]);

        
    }
    
}   

?>