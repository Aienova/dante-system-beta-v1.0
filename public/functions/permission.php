

<div id="loaderfeature"></div>
<?php


include_once("database.php");
include_once("functions.php");


$tokens = explode('/', $url);
$featurepath=$tokens[sizeof($tokens)-1];

$featurename=str_replace(".php","",$featurepath);
echo "<div id='restrictions'></div>";
echo "<div id='print'></div>";

if(isset($_POST['idfeature'])  ){

   Profile($featurename,"Demande de congé n°".$_POST['idfeature'],$_POST['idfeature']); 

   echo  '<script>$("#backtofeature").removeClass("hidden");</script>';

}else{


    $userlevel=selecter("user","id",the_iduser(),"level");

    $thetitle="Vos congés";

    if($featurename=="permission" && $userlevel==3 ){

        $thetitle="Liste des congés de votre agence";
    }

    if($featurename=="permission" && $userlevel<3 ){

        $thetitle="Liste des congés dans toutes les agences";
    }

    
    Table($featurename,$thetitle);
}


?>



<?php include 'script.php'; ?>



