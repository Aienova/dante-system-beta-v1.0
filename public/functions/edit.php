
<?php


include_once("database.php");
include_once("functions.php");


    $feature=$_POST['featurename'];
    $id=$_POST['featureid'];
    $value=$_POST['valuename'];
    $result=$_POST['setvalue'];
    $featuremessage=$_POST['featuremessage'];

    if(isset($_POST['quantity'])){


        $quantity=$_POST['quantity'];

    }else{

        $quantity=0;
    }

    EditValue($feature,$value,$result,$quantity,$id);

    echo $featuremessage;


?>


