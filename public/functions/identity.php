



<img class="user-icon" src="build/media/icons/user.png" />




<h2>

<?php


include "database.php";
include 'functions.php';


$dante_ip=file_get_contents("../connections/user".$_SESSION["user"].".txt");



   echo  strtoupper(selecter("user","ip_address",$dante_ip,"surname"))." ".ucfirst(selecter("user","ip_address",$dante_ip,"firstname"));





?>


</h2>


