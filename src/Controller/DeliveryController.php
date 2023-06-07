<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class DeliveryController extends AbstractController{


    public function delivery(): Response {

        return $this->render("delivery/index.html.twig",["controller_name" => "DeliveryController",]);

        
    }
}   

?>