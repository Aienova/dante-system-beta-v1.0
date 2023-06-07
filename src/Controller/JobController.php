<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class JobController extends AbstractController{

    public function job(): Response {

        return $this->render("job/index.html.twig",["controller_name" => "JobController",]);

        
    }
    
}   

?>