<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;




class QuotationController extends AbstractController{


    public function quotation(): Response {

        return $this->render("quotation/index.html.twig",["controller_name" => "QuotationController",]);

        
    }
    
}   

?>