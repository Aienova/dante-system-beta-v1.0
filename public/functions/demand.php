
<?php


include_once("database.php");
include_once("functions.php");


    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $pseudo=$_POST['nickname'];
    $message=$_POST['message'];

    Send_demand($email,$pseudo,$message,$subject);


?>


