<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class PartnerController extends AbstractController{


    public function partner(): Response {

        return $this->render("partner/index.html.twig",["controller_name" => "PartnerController",]);

        
    }
    
}   

?>