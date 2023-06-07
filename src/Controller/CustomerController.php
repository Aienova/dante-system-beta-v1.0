<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;




class CustomerController extends AbstractController{


    public function customer(): Response {

        return $this->render("customer/index.html.twig",["controller_name" => "CustomerController",]);

        
    }
    
}   

?>