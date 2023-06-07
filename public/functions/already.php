
<?php

if(isset($_POST['name']) && ($feature=="institute" || $feature=="customer")){

    $query="SELECT * FROM ".$feature." WHERE name ='".htmlentities($_POST['name'])."'";

    $nameexist=counter($database,$query);

    if($nameexist==1){


        include "fr_feature.php";

        echo "Ce nom existe déjà dans la table : ".$featurename;
        exit;

    }
}




?>