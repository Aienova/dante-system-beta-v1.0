<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class BillingController extends AbstractController{

    public function billing(): Response {

        return $this->render("billing/index.html.twig",["controller_name" => "BillingController",]);
        
    }
    
    
}   

?>