
<div id="loaderfeature"></div>
<?php  




include_once("database.php");
include_once("functions.php");


$level=selecter("user","id",the_iduser(),"level"); 

if($level>3){

?>

<style>
.restricted-editor{
display:none;
}
</style>

<?php

}


$tokens = explode('/', $url);
$featurepath=$tokens[sizeof($tokens)-1];

$featurename=str_replace(".php","",$featurepath);

echo "<div id='restrictions'></div>";
echo "<div id='print'></div>";

if(isset($_POST['idfeature'])  ){
 
   Profile($featurename,"Utilisateur n°".$_POST['idfeature'],$_POST['idfeature']); 

   echo  '<script>$("#backtofeature").removeClass("hidden");</script>';

}else{


    Table($featurename,"Les utilisateurs");
}


?>




<?php include 'script.php'; ?>





