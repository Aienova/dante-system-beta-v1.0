

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<?php


include_once("database.php");
include_once("functions.php");




$tokens = explode('/', $url);
$featurepath=$tokens[sizeof($tokens)-1];

$featurename=str_replace(".php","",$featurepath);

echo "<div id='restrictions'></div>";
echo "<div id='print'></div>";

echo ' <script>  $("#addtofeature").removeClass("hidden");  </script>';

if(isset($_POST['idfeature'])  ){



 
   Profile($featurename,"Demande de formation n°".$_POST['idfeature'],$_POST['idfeature']); 

   echo  '<script>
   
   $("#backtofeature").removeClass("hidden");

   
   </script>';

}else{

    ?>

<h3>Recette totale des formations cette année: <span style="color:white;"><?php  echo stat_total('formation','amount');  ?> €</span></h3>

<?php
    
    Table($featurename,"Vos formations");



}





?>




<?php include 'script.php'; ?>





