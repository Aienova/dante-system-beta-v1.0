<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;




class CertificateController extends AbstractController{


    public function certificate(): Response {

        return $this->render("certificate/index.html.twig",["controller_name" => "CertificateController",]);

        
    }
    
}   

?>