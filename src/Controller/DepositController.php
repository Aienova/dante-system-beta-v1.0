<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class DepositController extends AbstractController{


    public function deposit(): Response {
            
        return $this->render("deposit/index.html.twig",["controller_name" => "DepositController",]);

    }
}   

?>