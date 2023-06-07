
<?php


include_once("database.php");
include_once("functions.php");


    $id_category=$_POST['category'];
    $id_conciler=1;
    $id_concilan_demand=$_POST['demand'];
    $message=$_POST['message'];

    Send_advice($message,$id_conciler,$id_category,$id_concilan_demand);


?>


