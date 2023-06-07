
<?php


include_once("database.php");
include_once("functions.php");

if(isset($_POST['isfilter'])|| isset($_POST['filter']) ){

    $isfilter=$_POST['isfilter'];
    $filter=$_POST['filter'];
}else{

    $isfilter=0;
$filter='';
}




        Select_demands($isfilter,$filter);


?>


