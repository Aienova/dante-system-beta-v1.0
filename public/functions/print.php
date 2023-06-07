
<?php


include_once("database.php");
include_once("functions.php");


    $feature=$_POST['featurename'];
    $id=$_POST['featureid'];

 
?>

<script>



$.get('build/library/documents/<?php echo $feature;  ?>.html',

    { '_': $.now() } // Prevents caching

).done(function(data) {

    // Here's the HTML
    var html = data;

   // const chars = {'a':'x','b':'y','c':'z'};







    var mywindow = window.open('', 'PRINT', 'height=800,width=800');

    document.body.innerHTML.replace(/Hello/g, "Hi");

var htmlchange = html.replace('[[currenttime]]','<?php echo date("d/m/Y");  ?>').replace('[[limittime]]','<?php $date = date('d/m/Y', strtotime(' + 1 months')); echo $date; ?>')<?php include 'print-data.php'; ?>;



mywindow.document.write(htmlchange);




mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus();

mywindow.print();


return true;


}).fail(function(jqXHR, textStatus) {

    // Handle errors here

});

$(document).ajaxStop(function(){
    $("#loaderfeature").html("");
 
});



</script>
