
<?php



include_once("database.php");
include_once("functions.php");


    $feature=$_POST['featurename'];
    $id=$_POST['featureid'];


 
?>
<div id="notification"></div>
<a id="backtofeature" class="hidden" href=""><div class="navigate"> <img class="pictos" src="build/media/icons/return.png"/>Retour à la page principale<span class="featurespan"></span></div></a>
 


<h2>Visualisation de la <?php $featurename=""; include "fr_feature.php"; echo $featurename;  ?> n°<?php echo $id ?></h2>

       
<iframe id="viewer"></iframe>
<div id="decision">

<?php if(selecter($feature,"id_".$feature,$id,"decision")==3){ ?>
    <h3>1er Validation : Quel est votre décision ?</h3>
    <button data-id="<?php echo $id ?> " class="actionbutton waiting"  data-frh="<?php echo $feature ?> "><img   class='pictos' src='/build/media/icons/chronometre.png'/>Valider</button>
              <button data-id="<?php echo $id ?>"  class="actionbutton choosing" data-decision="0" data-frh="<?php echo $feature ?>" ><img class="pictos" src="/build/media/icons/no.png"> Refuser</button>
             
              <?php }  ?>

           <?php 

$querycheckamount="SELECT *,SUM(amount) AS totalamount FROM formation WHERE id_formation='".$id."' GROUP BY id_formation ";//BAAAK
$checkamount = $database->prepare($querycheckamount);
$checkamount->execute();
$checkdata = $checkamount->fetch();
           
           
           if(selecter($feature,"id_".$feature,$id,"decision")==2 ){ 


            $hidden="";
            
            $hiddenclass="";

            $messagevalidation="";

        

            if($feature=="formation"){

                $featurename="";
                include "fr_feature.php";

           if($checkdata['totalamount']>=selecter("dante_config","id_user",1,"higher_amount")){
               
            $hidden="restricted-5 restricted-4 restricted-3 restricted-2";

            if(the_level()>1){
            $messagevalidation="<h3>Montant élevé , en attente de validation de l'administrateur </h3>";
            }

           }


           if($checkdata['totalamount']<selecter("dante_config","id_user",1,"higher_amount") || the_level()<2){

          

           }
        }


        if($feature=="permission"){

            $featurename="";
            include "fr_feature.php";

            $hiddenclass="class='hidden'";

            if(the_level()==3){

                $ownrestricted="";

                $checkown=selecter($feature,"id_permission",$id,"id_personal");

                if(the_idpersonal()==$checkown){$ownrestricted="restricted-3";
                    $messagevalidation="<h3>En attente de validation de la direction</h3>";
                
                }


                $hidden=$ownrestricted." restricted-4 restricted-5";
                

            }

            if(the_level()==4){


                 $ownrestricted="";

                $checkown=selecter($feature,"id_permission",$id,"id_personal");

                if(the_idpersonal()==$checkown){$ownrestricted="restricted-4";
                    $messagevalidation="<h3>En attente de validation de la direction</h3>";
                }

                $hidden=$ownrestricted." restricted-5";
                

            }

            if(the_level()==5){

                $ownrestricted="";

                $checkown=selecter($feature,"id_permission",$id,"id_personal");

                if(the_idpersonal()==$checkown){$ownrestricted="restricted-4";
                    $messagevalidation="<h3>En attente de validation de la direction</h3>";
                
                }

                $hidden=$ownrestricted." restricted-5";


            }

        }


            ?>

            <div class="decisions <?php echo $hidden;  ?>">
            <h3>Validation finale : Quel est votre décision ?</h3>
           
            <button data-id="<?php echo $id ?> " class="actionbutton choosing "  data-decision="1" data-frh="<?php echo $feature ?> " ><img   class='pictos' src='/build/media/icons/yes.png'/>Valider</button>
              <button data-id="<?php echo $id ?>"  class="actionbutton choosing  " data-decision="0" data-frh="<?php echo $feature ?>" ><img class="pictos" src="/build/media/icons/no.png"> Refuser</button>
                     </div>

                     <?php echo $messagevalidation ?>


                     


        <?php
                
           }

            ?>




              <?php if(selecter($feature,"id_".$feature,$id,"decision")==1){ ?>
                    <h3>Demande de <?php echo $featurename; ?> validée</h3>
              <?php }  ?>

              <?php if(selecter($feature,"id_".$feature,$id,"decision")==0){ ?>
                <h3>Demande de <?php echo $featurename; ?> rejetée </h3>
                <p><strong style="color:red;">Explication du refus :<?php echo selecter($feature,"id_".$feature,$id,"excuses") ?></strong></p>
                
                
                <button data-id="<?php echo $id ?> " class="actionbutton choosing"  data-decision="1" data-frh="<?php echo $feature ?> "><img   class='pictos' src='/build/media/icons/yes.png'/>Valider</button>
              <button data-id="<?php echo $id ?>"  class="actionbutton choosing" data-decision="0" data-frh="<?php echo $feature ?>" ><img class="pictos" src="/build/media/icons/no.png"> Refuser</button>
             
              <?php }  ?>


           

</div>

<script>

$("#addtofeature").addClass("hidden");
$("#backtofeature").removeClass("hidden");

$.get('build/library/documents/<?php echo $feature;  ?>.html',

    { '_': $.now() } // Prevents caching

).done(function(data) {

    // Here's the HTML
    var html = data;

   // const chars = {'a':'x','b':'y','c':'z'};


    var viewer = document.getElementById('viewer').contentWindow.document;

    document.body.innerHTML.replace(/Hello/g, "Hi");

var htmlchange = html.replace('[[currenttime]]','<?php echo date("d/m/Y");  ?>').replace('[[limittime]]','<?php $date = date('d/m/Y', strtotime(' + 1 months')); echo $date; ?>')<?php include 'print-data.php'; ?>;

viewer.open();

viewer.write(htmlchange);


viewer.close(); // necessary for IE >= 10




return true;


}).fail(function(jqXHR, textStatus) {

    // Handle errors here

});


</script>


<script type="text/javascript">

    var iframe=document.getElementById("viewer");
    iframe.contentWindow.addEventListener("scroll",function(event){ console.log(event)},false);
    iframe.contentWindow.onscroll = function(){
        alert("scrolling...");
      }
    
</script>

<?php include "script.php"; ?>