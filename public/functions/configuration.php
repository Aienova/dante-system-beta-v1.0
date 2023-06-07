

<?php


include_once("database.php");
include_once("functions.php");



?>

<script>

$("#addtofeature").addClass("hidden");

</script>


<h1>Configurer les paramètres généraux de votre Dante</h1>

<style>

#editform{

        height:auto!important;

}

</style>

<div id="notification"></div>


        <form id="sender" data-action="edittable" method="POST" action>

        <?php
               EditTableform("Config du système",1,"dante_config","Les paramètres ont été modifié");

    ?>
                <input type="submit" value="Modifier les paramètres" />
                </form>




</div>



<?php include "script.php";  ?>










  


  
