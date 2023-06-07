
<?php


include_once("database.php");
include_once("functions.php");


    $feature=$_POST['featurename'];
    $id=$_POST['featureid'];


 
?>
<div id="notification"></div>
<a id="backtofeature"  href=""><div class="navigate"> <img class="pictos" src="build/media/icons/return.png"/>Retour à la page principale<span class="featurespan"></span></div></a>
 


<h2>Répondre au refus de la <?php include "fr_feature.php"; echo $featurename;  ?> n°<?php echo $id ?></h2>




                <p><strong>Nom du valideur :</strong><?php echo selecter($feature,"id_".$feature,$id,"validator") ?></p>
       

                <p><strong>Commentaire du valideur :</strong><br><?php echo selecter($feature,"id_".$feature,$id,"excuses") ?></p>




                <form id="sender" data-action="again" method="POST">
                    <label><strong>Vos explications</strong></label><br><br>
                    
                    <input type="hidden" name="validator" value="<?php echo selecter($feature,"id_".$feature,$id,"validator") ?>" />
                    <input type="hidden" name="feature" value="<?php echo $feature ?>" />
                    <input type="hidden" name="sendername" value="<?php echo the_username() ?>" />
                    <input type="hidden" name="id" value="<?php echo $id ?>" />
                    <textarea style='max-width:500px; min-width:500px; min-height:100px; max-height:200px;' name="comment"></textarea>
        <br>
                    <input type="submit" style="width:fit-content;" value="Demander une nouvelle validation" />
                        </form>
  
</div>

<?php include "script.php"; ?>