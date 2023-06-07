
<?php


include_once("database.php");
include_once("functions.php");


    $feature=$_POST['featurename'];
    $id=$_POST['featureid'];
    $featuremessage=$_POST['featuremessage'];
 


    DeleteValue($feature,$id);


  

    echo $featuremessage;

    if($feature=="institute"){

        DeleteValues("certificate","id_institute",$id);

        echo "<br>Les intitulés de cette organisme ont été supprimés";

    }


?>


