<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class CalendarController extends AbstractController{


    public function calendar(): Response {

        return $this->render("calendar/index.html.twig",["controller_name" => "CalendarController",]);

        
    }
    
    
}   

?>