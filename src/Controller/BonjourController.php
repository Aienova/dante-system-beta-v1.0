<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;



class BonjourController{

    function bonjour(){

        return new Response ("Hello My Bitches");
    }


}

?>