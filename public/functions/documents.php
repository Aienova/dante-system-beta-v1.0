

<script>

$("#addtofeature").addClass("hidden");

</script>

<style>


span.ifempty {
    color: red;
    display: inline-block;
    transform: translate(25px, -15px);
}


</style>


<?php


include_once("database.php");
include_once("functions.php");


$tokens = explode('/', $url);
$featurepath=$tokens[sizeof($tokens)-1];

$featurename=str_replace(".php","",$featurepath);

echo "<div id='restrictions'></div>";
echo "<div id='notification'></div>";

echo "<h1>Vos dossiers de formations</h1>";


echo "<div class='flexible'><div id='filespace'><div id='explorer'>


</div>



<div id='profiler'></div>";

?>

<script>
$(document).ready(function() {

if (localStorage.getItem("directory")) {

  var parent = "/";

  // Restauration du contenu du champ
  var path = localStorage.getItem("directory")+"/";

console.log("open directory :"+path);

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

}

});

</script>

<?php include 'script.php'; ?>





