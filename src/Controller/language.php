<?php

include "database.php";


    function language(){

    $query="SELECT * FROM dante_config";

    $request = $database->prepare($query);
            $request->execute();
            $data=$request->fetch();
           
            return $data["language"];

        }
            



?>