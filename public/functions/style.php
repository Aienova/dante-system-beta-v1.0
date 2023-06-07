



<?php



echo "<style>";


include "database.php";

$query="SELECT * FROM permission WHERE id_".$_POST['featurename']."=".$_POST['idfeature']."";



$request = $database->prepare($query);
$request->execute();

while($data=$request->fetch()){

    echo "#date-".$data['date_start']."{ 
        
        background-image:url(./build/media/images/permission_fr.png);
    
    }";

}

echo "</style>";


?>