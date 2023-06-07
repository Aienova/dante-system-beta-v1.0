
<?php


include_once("database.php");
include_once("functions.php");


    $feature=$_POST['featurename'];




    if($feature=="institute"){

        $filesend="enctype='multipart/form-data'";
    }else{

        $filesend="";

    }
    

        echo '<div id="notification"></div>';

        if($feature=="consulting" || $feature=="customer" || $feature=="institute" || $feature=="certificate"){

            echo '<a style="margin-left:10px; text-align:right; float:right; text-decoration:none; " href="/formation"><div class="navigate" style=" background-color: #bcff00!important;color:black!important;"> <img class="pictos" src="build/media/icons/add.png"/>Ajouter une demande de formation<span class="featurespan"></span></div></a>';
            
        }   


        echo '    
        <a id="backtofeature"  href=""><div class="navigate"> <img class="pictos" src="build/media/icons/return.png"/>Retour à la page principale<span class="featurespan"></span></div></a>
        ';
        echo "<form id='sender' data-action='addtable' ".$filesend." method='POST' action='' >";


        $featurename=$feature;


        include 'fr_feature.php';

                if($feature=='user' || $feature=='consulting' || $feature=='formation' || $feature=='permission' || $feature=="certificate"){


                    if($feature=='formation' || $feature=='permission' ){

                        echo "<h3>Ajouter une nouvelle <span style='text-transform:lowercase'>".$featurename."</span> </h3>";
                            
                    }else{

                        echo "<h3>Ajouter un nouvel <span style='text-transform:lowercase'>".$featurename."</span> </h3>";  

                    }

                    
                }

              
                
                else{


                    echo "<h3>Ajouter un nouveau <span style='text-transform:lowercase'>".$featurename."</span> </h3>";


                }

           



                AddTableform($feature,"Les données ont été ajouté");

                
                echo "<input type='submit' value='Ajouter'></div>";
        
                

               
                echo "</form>";

                echo  '<script>
                
                $("#backtofeature").removeClass("hidden");
                $("#addtofeature").addClass("hidden");

                

    

                
                </script>';
                include "script.php";





?>

<!--

        if(isset($_POST['name'])){if($_POST['name']==""){echo "Veuillez donner un nom";exit;}}
        if(isset($_POST['surname'])){if($_POST['surname']==""){echo "Veuillez donner un nom de famille";exit;}}
        if(isset($_POST['firstname_contact'])){if($_POST['firstname_contact']==""){echo "Veuillez donner un prénom à votre interlocuteur";exit;}}
        if(isset($_POST['surname_contact'])){if($_POST['surname_contact']==""){echo "Veuillez de donner un nom de famille à votre interlocuteur";exit;}}
        if(isset($_POST['firstname'])){if($_POST['firstname']==""){echo "Veuillez donner un prénom";exit;}}
        if(isset($_POST['role'])){if($_POST['role']==""){echo "Veuillez donner un poste";exit;}}
        if(isset($_POST['qualiopi_number'])){if($_POST['qualiopi_number']==""){echo "Veuillez donner un numéro qualiopi";exit;}}
        if(isset($_POST['speciality'])){if($_POST['speciality']==""){echo "Veuillez donner un métier";exit;}}
        if(isset($_POST['login'])){if($_POST['login']==""){echo "Veuillez rentrer un identifiant";exit;}}
        if(isset($_POST['password'])){if($_POST['password']==""){echo "Veuillez rentrer un mot de passe ";exit;}}
        if(isset($_POST['hourly_rate'])){if($_POST['hourly_rate']=="" && $feature!="formation"){echo "Veuillez définir le taux horaire ";exit;}}
        if(isset($_POST['email'])){if($_POST['email']==""){echo "Veuillez rentrer une adresse email ";exit;} if(!str_contains($_POST['email'],'@')){echo "Adresse email invalide ";exit;}}
      


            -->

<script>

$( "#id_institute label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#id_certificate label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#id_costumer label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#id_consulting label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#id_personal label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#absence_type label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#name label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#contact label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#qualiopi_number label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#hourly_rate label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#password label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#login label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#speciality label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#role label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#email label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#surname label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#firstname label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#id_agency label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#id_company label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#hour label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#cost label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#date_contrat_start label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#date_contrat_end label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#date_birth label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#date_start label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#date_end label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#reason label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#date_absence_start label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );
$( "#date_absence_end label" ).append( "<span style='color:red;margin-left:5px;'>*</span>" );



</script>
