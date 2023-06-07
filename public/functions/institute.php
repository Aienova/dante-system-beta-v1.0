
<?php


include_once("database.php");
include_once("functions.php");




$tokens = explode('/', $url);
$featurepath=$tokens[sizeof($tokens)-1];

$featurename=str_replace(".php","",$featurepath);

echo "<div id='print'></div>";

if(isset($_POST['idfeature'])  ){



 
   Profile($featurename,"Organisme n°".$_POST['idfeature'],$_POST['idfeature']); 

   echo  '<script>$("#backtofeature").removeClass("hidden");</script>';

}else{


    Table($featurename,"Vos organismes de formation");
}


?>




<?php include 'script.php'; ?>





