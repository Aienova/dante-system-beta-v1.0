<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class DocumentsController extends AbstractController{


    public function documents(): Response {

        return $this->render("documents/index.html.twig",["controller_name" => "DocumentsController",]);

        
    }
}   

?>