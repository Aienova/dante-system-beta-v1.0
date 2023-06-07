


<?php

include "database.php";

    $where=" WHERE id_institute=".$_POST['instituteid'];

$query="SELECT * FROM certificate ".$where;

$request = $database->prepare($query);
        $request->execute();


        $result="";


        while ($data=$request->fetch()){


                    $dataname=$data['name']." - ".$data['hour']."h";

            
            $result="<option data-name='".$dataname."' data-hour='".$data['hour']."' value='".$data['id']."'    >".$dataname."</option>";

    
        echo $result;

        }



?>