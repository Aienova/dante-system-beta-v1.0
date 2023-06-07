<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class PermissionController extends AbstractController{


    public function permission(): Response {

        return $this->render("permission/index.html.twig",["controller_name" => "PermissionController",]);

        
    }
    
    
}   

?>