<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class JobofferController extends AbstractController{

    public function joboffer(): Response {

        return $this->render("job-offer/index.html.twig",["controller_name" => "JobofferController",]);

    }
    
}   

?>