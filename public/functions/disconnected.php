

<?php

include "database.php";
include 'functions.php';


$iduser=the_iduser();


disabled($iduser);

file_put_contents("../connections/user".$_SESSION["user"].".txt", "");

unset($_SESSION["user"]);

echo "<script>window.location.replace('/connection');</script>"; 
               

?>

