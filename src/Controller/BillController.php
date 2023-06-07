<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class BillController extends AbstractController{


    public function bill(): Response {

        return $this->render("bill/index.html.twig",["controller_name" => "BillController",]);

        
    }
}   

?>