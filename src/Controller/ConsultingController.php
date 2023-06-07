<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;




class ConsultingController extends AbstractController{


    public function consulting(): Response {

        return $this->render("consulting/index.html.twig",["controller_name" => "ConsultingController",]);

        
    }
    
}   

?>