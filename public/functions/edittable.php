
<?php


include_once("database.php");
include_once("functions.php");


    $feature=$_POST['featurename'];
    $id=$_POST['featureid'];
    $featuremessage=$_POST['featuremessage'];


    $query="SHOW COLUMNS FROM ".$feature." WHERE Extra NOT LIKE '%auto_increment%'";
    
    $column = $database->prepare($query);
    $column->execute();
 
    include "require.php";


    while ($columndata = $column->fetch()){

        if($feature=="formation"){


            /*DOUBLON---*/
            if (in_array($columndata['Field'], ['cost', 'id_customer','certificate_name','institute_name','hour'])) {

                $idformation=selecter("formation","id",$id,"id_formation");

                $queryold="SELECT * FROM formation WHERE id_formation='".$idformation."'";
                $requestold = $database->prepare($queryold);
                $requestold->execute();


                while($dataold=$requestold->fetch()){



                    $totalold=$dataold['wage']+$_POST['cost'];

                    $querynew="UPDATE formation SET amount =".$totalold." WHERE id=".$dataold['id'];
                    $requestnew = $database->prepare($querynew);
                    $requestnew->execute();

                }


            $query="UPDATE formation SET ".$columndata['Field']."='".$_POST[$columndata['Field']]."' WHERE id_formation='".$idformation."'";

            $request = $database->prepare($query);
                    $request->execute();

        }

        if (in_array($columndata['Field'], ['hourly_rate'])) {


            $_POST['wage']=$_POST['hour']*$_POST['hourly_rate']*selecter("dante_config","id_user",1,"directory_coef");

            $total=$_POST['wage']+$_POST['cost'];

            $query2nd="UPDATE formation SET wage ='".$_POST['wage']."' WHERE id=".$id;
            
            $query3rd="UPDATE formation SET amount ='".$total."' WHERE id=".$id;


            $request2nd = $database->prepare($query2nd);
            $request3rd = $database->prepare($query3rd);
                    $request2nd->execute();
                    $request3rd->execute();

        }



   



    }

        if (in_array($columndata['Field'], ['id_customer', 'id_user','fr_role','fr_title','licence'])) {

                echo "";

        }else{

            if(isset($_POST['address'])){

                $_POST['address']=$_POST['number_address']." ".$_POST['street_address']." ".$_POST['city_address']." ".$_POST['postal_address'];

            }


            if(isset($_POST['contact'])){

                $_POST['contact']=$_POST['firstname_contact']." ".$_POST['surname_contact'];

            }

            $query="UPDATE ".$feature." SET ".$columndata['Field']."='".$_POST[$columndata['Field']]."' WHERE id=".$id;
            executer($database,$query);
        
        }


        if($feature=="user"){

            $idpersonal=selecter("personal","id_user",$id,"id");
            $firstname=finder($database,$id,"user","firstname");
            $surname=finder($database,$id,"user","surname");
            $email=finder($database,$id,"user","email");
            $datearrive=finder($database,$id,"user","date_arrive");
            $datebirth=finder($database,$id,"user","date_birth");
            $role=finder($database,$id,"user","role");
            $telephone=finder($database,$id,"user","telephone");
            $idagency=finder($database,$id,"user","id_agency");

            updater($database,"personal","firstname",$firstname,$idpersonal);
            updater($database,"personal","surname",$surname,$idpersonal);
            updater($database,"personal","email",$email,$idpersonal);
            updater($database,"personal","date_arrive",$datearrive,$idpersonal);
            updater($database,"personal","date_birth",$datebirth,$idpersonal);
            updater($database,"personal","role",$role,$idpersonal);
            updater($database,"personal","telephone",$telephone,$idpersonal);
            updater($database,"personal","id_agency",$idagency,$idpersonal);

        }


        if($feature=="personal"){


            $iduser=selecter("personal","id",$id,"id_user");
            $firstname=finder($database,$id,"personal","firstname");
            $surname=finder($database,$id,"personal","surname");
            $email=finder($database,$id,"personal","email");
            $datearrive=finder($database,$id,"personal","date_arrive");
            $datebirth=finder($database,$id,"personal","date_birth");
            $role=finder($database,$id,"personal","role");
            $telephone=finder($database,$id,"personal","telephone");
            $idagency=finder($database,$id,"personal","id_agency");

            updater($database,"user","firstname",$firstname,$iduser);
            updater($database,"user","surname",$surname,$iduser);
            updater($database,"user","email",$email,$iduser);
            updater($database,"user","date_arrive",$datearrive,$iduser);
            updater($database,"user","date_birth",$datebirth,$iduser);
            updater($database,"user","role",$role,$iduser);
            updater($database,"user","telephone",$telephone,$iduser);
            updater($database,"user","id_agency",$idagency,$iduser);

        }



    }

    echo "Les données ont été modifié avec succès";


?>


