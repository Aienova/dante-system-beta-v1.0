<?php

include_once("database.php");
include_once("functions.php");




$dante_ip=file_get_contents("../connections/user".$_SESSION["user"].".txt");

$iduser=selecter("user","ip_address",$dante_ip,"id");

$level=selecter("user","id",$iduser,"level");

$tokens = explode('/', $url);
$featurepath=$tokens[sizeof($tokens)-1];

$featurename=str_replace(".php","",$featurepath);

$feature=$featurename;

include "level-".selecter("level","id",$level,"level_tag").".php";



?>



