
<style>

a#addtofeature {
    display: none;
}

</style>


<?php


include_once("database.php");
include_once("functions.php");


$tokens = explode('/', $url);
$featurepath=$tokens[sizeof($tokens)-1];

$featurename=str_replace(".php","",$featurepath);

echo "<div id='restrictions'></div>";
echo "<div id='print'></div>";




?>

<div id="statdata">
<h2>Statistique de vos données</h2>
<div class="flexible">
<div class="stat"><span class="numbers"><?php  echo stat_count('personal');  ?></span><br><span class="statname">Nombre de salariés</span></div>
<div class="stat"><span class="numbers"><?php  echo stat_count('bill');  ?></span><br><span class="statname">Nombre de prestation</span></div>
<div class="stat"><span class="numbers"><?php  echo stat_count('customer');  ?></span><br><span class="statname">Nombre de client</span></div>
</div>

<?php  $year=date("Y");

echo "<h2>Chiffres de l'année ".$year."</h2>";
?>

<h3>Recette totale : <span style="color:white;"><?php  echo stat_total('bill','amount',$year);  ?> €</span></h3>
<h3>Type de prestation la plus demandée : <span style="color:red;">Données Indisponibles</span></h3>
<h3>Entreprise la plus fidèle : <span style="color:white;"><?php  echo Top('formation','id_customer',$year);  ?></span></h3>


</div>

<div id="nodata" class='hidden'><h2>Données inaccessibles pour votre compte</h2></div>

<?php include 'script.php'; ?>




