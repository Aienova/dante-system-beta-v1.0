<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class MainpermissionController extends AbstractController{

    public function mainpermission(): Response {

        return $this->render("mainpermission/index.html.twig",["controller_name" => "MainpermissionController",]);

        
    }
    
    
}   

?>