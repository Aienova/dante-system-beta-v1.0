
<?php


include_once("database.php");
include_once("functions.php");


    $feature=$_POST['feature'];
    $id=$_POST['id'];
    $value=$_POST['comment'];
    $sendername=$_POST['sendername'];

    $query="UPDATE ".$feature." SET comment='".str_replace("'","&#039",$value)."' WHERE id_".$feature."='".$id."' ";
    $query2="UPDATE ".$feature." SET decision=2 WHERE id_".$feature."='".$id."'";


    $request = $database->prepare($query);
            $request->execute();

            $request2 = $database->prepare($query2);
            $request2->execute();

            $mailtype=4;
           /* include "sendmail.php";*/

    echo  "Votre demande a bien été enregistrée et envoyée";

    ?>
