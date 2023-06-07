<?php




include "config.php";

    $database = new PDO ('mysql:host='.$host.';dbname='.$dbname,$dbuser,$dbpassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

?>