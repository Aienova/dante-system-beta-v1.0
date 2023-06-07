<style>

label.sub-directory {
    transform: translateY(-13px);
    display: inline-flex;
    font-weight: bolder;
}

</style>


<?php


$source="../../public/build/library/stockage";


$parent="/";

$directory="";

$folder=$source.$parent.$directory;

if(isset($_GET['directory'])){


   $source="../../public/build/library/stockage";


$directory=$_GET['directory'];

$folder=$source.$parent.$directory;

}



if(isset($_POST['directory'])){

   $oldparent=$_POST['parent'];

   $directory=$_POST['directory'];

   $parent=$oldparent.$directory;

   $folder=$source.$oldparent.$directory;

   $directorymessage="<h4>Vous êtes dans le dossier ".$directory."</h4>";

}

if(isset($_POST['returndirectory'])){

   

   $oldparent=$_POST['returndirectory'];

   $parent=$oldparent;

   $folder=$source.$oldparent;

   $directorymessage="<h4>Vous êtes de retour dans le dossier ".$directory."</h4>";

}



$scan = scandir($folder);


echo "<strong>Dossier actuel :</strong>".$parent;


echo "<div class='flexible'>";
echo "<ul id='navigator'>";
$i=-1;


foreach($scan as $file) {

     if($i<1){

        $classes="class='hidden'";
     }else{

        $classes='class="explore"';
     }

     

   if (str_contains($file,'.')) {


      $location = "../../public/build/library/stockage".$parent.$file;
      $location2 = "../../public/build/library/stockage".$parent.$file;

      $li="<li id='file".$i."'  ".$classes."><img class='icon' src='../../build/media/icons/file.png'><span class='filename'>".$file."</span>".'<span class="actions-directory"><a href="'.$location.'" target="blank"><img class="pictos" src="/build/media/icons/eye.png"></a><img class="pictos deletefile" data-path="'.$location2.'" src="/build/media/icons/delete.png"></li>';



      echo $li;
   


}else{


   $empty="";

   $dir = 'directory';

   $location2 = "../../public/build/library/stockage".$parent.$file."/";

   
   if((count(glob($location2."*")) === 0)){

      $empty="Vide";

} 



      if (in_array($file, ["Certificat réussi", "Convention","Facture","Fiche d'émargement","Programme","Convocation"])) {
            $subhidden="hidden";
         }else{

            $subhidden="";
         }

         $subfolder="style='color:green;'";



if((count(glob($location2."Certificat réussi/*")) === 0)){



   $subfolder1="style='color:red;'";

} else{

   $subfolder1="style='color:green;'";

}



if((count(glob($location2."Convention/*")) === 0)){

   $subfolder2="style='color:red;'";

} else{

   $subfolder2="style='color:green;'";

}



if((count(glob($location2."Facture/*")) === 0)){

   $subfolder3="style='color:red;'";

} else{

   $subfolder3="style='color:green;'";

}


if((count(glob($location2."Fiche d'émargement/*")) === 0)){

   $subfolder4="style='color:red;'";

} else{

   $subfolder4="style='color:green;'";

}


if((count(glob($location2."Programme/*")) === 0)){

   $subfolder5="style='color:red;'";

} else{

   $subfolder5="style='color:green;'";

}


if((count(glob($location2."Convocation/*")) === 0)){

   $subfolder6="style='color:red;'";

} else{

   $subfolder6="style='color:green;'";

}


   $li="<li id='folder".$i."'  ".$classes." style='padding:30px;'><img class='icon' src='../../build/media/icons/folder.png'><span class='filename'>".$file."</span><span class='ifempty'>".$empty."</span>".'<span class="actions-directory">      <label class="sub-directory '.$subhidden.'"> <span '.$subfolder2.'>Con</span> | <span '.$subfolder5.'>Pro</span> | <span '.$subfolder4.'>Ema</span> | <span '.$subfolder1.'>Ctf</span> |  <span '.$subfolder3.'>Fact</span> | <span '.$subfolder6.'>Conv</span> </label><br><img class="pictos openfolder" data-parent="'.$parent.'" data-directory="'.$file.'/" src="/build/media/icons/eye.png" /><img class="pictos deletefolder" data-path="'.$location2.'" src="/build/media/icons/delete.png" /></span></li>';

   echo $li;
}


$i++;

}



if($i==1){


   echo "<h3>Ce répertoire ne contient ni fichiers ni dossiers</h3>";


}


echo "</ul>";


include 'dragndrop.php'; 


echo "</div>";


echo "<a href='./documents'><span class='actionbutton'>Revenir à la racine</span></a><span data-parent='".dirname($parent)."/' class='returnfolder actionbutton'>Revenir au dossier précédent</span><span data-parent='".$source.$parent."'  class='addfolder actionbutton'>Ajouter un dossier</span>
</div>";


echo "<div id='messager' class='hidden'></div>";

?>



<script>




$(".addfolder").click(function() {

   var parent = $(this).closest(".addfolder").attr("data-parent");
   var directory = prompt("Donnez un nom à votre nouveau dossier :", "");
   var action = "addfolder";


   $.ajax({
    url: "./functions/"+action+".php",
    type: "POST",
    data: { 
      
            directory : directory,
            parent : parent,
    
    
    },

    success: function(data) {

      $("#messager").html(data);
      window.location.reload();



},
error: function() {
   $("#messager").text("Erreur au niveau des directory");
   window.location.reload();
}


});






});



$(".returnfolder").click(function() {


var parent = $(this).closest(".returnfolder").attr("data-parent");


$.ajax({
  url: "./functions/explorer.php",
  type: "POST",
  data: { 
    
      returndirectory : parent,
  
  },



  success: function(data) {


      $("#explorer").html(data);


     },
     error: function() {
      $("#explorer").text("Erreur au niveau des directory");
     }


});


});



$(".openfolder").click(function() {

  var path = $(this).closest(".openfolder").attr("data-directory");
  var parent = $(this).closest(".openfolder").attr("data-parent");

  
  $.ajax({
    url: "./functions/explorer.php",
    type: "POST",
    data: { 
      
            directory : path,
            parent : parent,
    
    
    },



    success: function(data) {


        $("#explorer").html(data);


       },
       error: function() {
        $("#explorer").text("Erreur au niveau des directory");
       }


});


});



$(".deletefile").click(function() {


   console.log('delete this!');

var path = $(this).closest(".deletefile").attr("data-path");


$.ajax({
  url: "./functions/deletefile.php",
  type: "POST",
  data: { 
          path : path,
  },




  success: function(data) {


      $("#messager").html(data);

      window.location.reload();



     },
     error: function() {
      $("#messager").text("Erreur au niveau des directory");
     }


});


});





$(".deletefolder").click(function() {


console.log('delete this!');

var path = $(this).closest(".deletefolder").attr("data-path");


$.ajax({
url: "./functions/deletefolder.php",
type: "POST",
data: { 
       path : path,
},



success: function(data) {


   $("#deletemessage").html(data);

   window.location.reload();


  },
  error: function() {
   $("#deletemessage").text("Erreur au niveau des directory");
  }


});


});

$('form').submit(function(e){


var action = $("#sender").attr("data-action");
console.log("action :"+action);


  /*-----------UPLOAD SCRIPT-----------------*/
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    url: './functions/'+action+'.php',
    type: 'POST',
    data:formData,
              success: function(data){
               

                  $('#notification').html(data);

$('#notification').addClass("popup");
setTimeout(function() {

$('#notification').removeClass('popup');


},1500);

setTimeout(function() {

  window.location.reload();


},1600);



  
              },cache: false,
        contentType: false,
        processData: false

 
           });



});


</script>