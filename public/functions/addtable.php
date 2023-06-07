
<?php


include_once("database.php");
include_once("functions.php");


    $feature=$_POST['featurename'];

    $featuremessage=$_POST['featuremessage'];



        include "already.php";

        if($feature=="agenda"){

            $_POST["time"]="07h27";

        }

        if($feature=="quotation"){

            $price=finder($database,$_POST['id_delivery'],"delivery","price");
            $_POST["price"]=$price;
            $_POST["customer_name"]=finder($database,$_POST['id_customer'],"customer","name");
            $_POST["customer_telephone"]=finder($database,$_POST['id_customer'],"customer","telephone");
           
            $_POST["amount"]=$price*$_POST["quantity"];

        }


        if($feature=="deposit"){

            $amount=selecter("quotation","id_quotation",$_POST['id_quotation'],"amount");
            $_POST["amount"]=$amount;
           
        }
    


    if($feature=="formation"){



        if(isset($_POST['new-nb-consulting'])){

            $nb=$_POST['new-nb-consulting'];

            $_POST['nb_consulting']=$_POST['new-nb-consulting'];


        }else{

            $nb=$_POST['nb_consulting'];
        }





    }else{

        $nb=1;
    }

    if(isset($_POST['personalist'])){

        $_POST['id_personal']=$_POST['personalist'];

    }



    $query="SHOW COLUMNS FROM ".$feature." WHERE Extra NOT LIKE '%auto_increment%'";
    
    $column = $database->prepare($query);
    
    for($a=1;$a<=$nb;$a++){


        $column->execute();

   
        if(isset($_POST['id_consulting'])){

            if(isset($_POST['new-nb-consulting'])){

                $_POST['id_consulting']=0;

            }else{

                $_POST['id_consulting']=$_POST['id_consulting_'.$a];

            }



        }

        $columns="";
        $values="";
        $count = 0;

        
    while ($columndata = $column->fetch()){


        if($columndata['Field']=="hour_appi"){

            $_POST['hour_appi']=finder($database,$_POST["id_consulting"],"consulting","hour");
        }

        if($columndata['Field']=="left_permission"){


            $_POST['left_permission']=finder($database,$_POST["id_personal"],"personal","permission");

        }

       


        if($columndata['Field']=="count_permission"){

            $daycount=dater(strtotime($_POST['date_start']), strtotime($_POST['date_end']));

            

            if($daycount<=0){
                echo "Veuillez donner une date de début et de fin cohérente";
                exit;
            }

            $_POST['count_permission']=$daycount;

            if($_POST['reason']=="nopaid"){


                $_POST['paid']=$_POST['count_permission'];

                $_POST['total_count_permission']=0;

            }else{


                if($_POST['reason']=="family"){

                    $_POST['paid']=0;

                $_POST['total_count_permission']=0;

                }
                
                
                
                else{

                    if($_POST['reason']=="family"){

                        $_POST['paid']=0;
    
                    $_POST['total_count_permission']=0;
    
                    }else{
                        


                        if(($_POST['reason']=="other" || $_POST['reason']=="permission") && $_POST['count_permission']>$_POST['left_permission'] && $_POST['left_permission']>=0){

                            $_POST['total_count_permission']=$_POST['left_permission'];
                            $_POST['paid']=$_POST['count_permission']-$_POST['left_permission'];

                        }else{

                    /*--------------IGGDRASELSE TO TOP-----------------------------*/
                    $_POST['total_count_permission']=$_POST['count_permission']-$_POST['paid'];

                        }


                    }



                }


            

            }




        }


            if($columndata['Field']=="count_permission_2"){

                $_POST['count_permission_2']=0;
                
                $daycount=dater(strtotime($_POST['date_start_2']), strtotime($_POST['date_end_2']));
    
                
                if($daycount<-1){
                    echo "Veuillez donner une date de début et de fin cohérente pour le 2e congé";
                    exit;
                }



                
                if(intval($_POST['date_start_2'])<=0){

                    $_POST['count_permission_2']=0;

           

                }else{

                    $_POST['count_permission_2']+=$daycount;

                }

                $_POST['total_count_permission']+=$_POST['count_permission_2'];
    
    
            }

                        



            if($columndata['Field']=="count_permission_3"){

                $_POST['count_permission_3']=0;

 
                $daycount=dater(strtotime($_POST['date_start_3']), strtotime($_POST['date_end_3']));
    
                
                if($daycount<-1){


                    echo "Veuillez donner une date de début et de fin cohérente pour le 3e congé";
                    exit;

                }

                if(intval($_POST['date_start_3'])<=0){

                    $_POST['count_permission_3']=0;

                }else{

                    $_POST['count_permission_3']+=$daycount;

                }

                $_POST['total_count_permission']+=$_POST['count_permission_3'];
    
    
            }

        if($columndata['Field']=="count_absence"){

            $daycount=dater(strtotime($_POST['date_absence_start']), strtotime($_POST['date_absence_end']));

            
            if($daycount<=0){
                echo "Veuillez donner une date de début et de fin cohérente";
                exit;
            }

            $_POST['count_absence']=$daycount;


        }

        if($columndata['Field']=="paid"){

            if($_POST['paid']>$_POST['count_permission']){

                echo "Attention : Le nombres de CP sans solde dépasse la date de fin";
                exit;
            }

        }

        if($columndata['Field']=="anticipated"){

            if($_POST['left_permission']<$_POST['count_permission']){

                $_POST['anticipated']=(0-($_POST['count_permission']-$_POST['paid']))*(-1);

            }else{
                $_POST['anticipated']=0;
            }



        }

 
            // || $_POST['surname']=="" || $_POST['telephone']=="" || $_POST['email']==""  ||  $_POST['role']==""  ||  $_POST['surname']=="" || $_POST['name']=="" || $_POST['address']=="" || $_POST['siret']==""  || $_POST['telephone']=="" 


            include "require.php";

        if($columndata['Field']=='id' || $columndata['Field']=='fr_title'){


            $columns.="";


        }else{

        

            if($count<1){

                $virgule="";
            }else{

                $virgule=",";
            }

            $thevalue=$_POST[$columndata['Field']];

            if(str_contains($columndata['Field'], '_name') ){

     
                
                $columnfeature=str_replace("_name","",$columndata['Field']);
                

                if($columndata['Field']=="consulting_name" || $columndata['Field']=="personal_name"){

                   

        if(isset($_POST['new-nb-consulting'])){


            $thevalue=$_POST['new-surname-'.$a]." ".$_POST['new-firstname-'.$a];

        }else{

            $thevalue=finder($database,$_POST["id_".$columnfeature],$columnfeature,'surname')." ".finder($database,$_POST["id_".$columnfeature],$columnfeature,'firstname'); 
        }
                   


                

                }else{

                    $thevalue=finder($database,$_POST["id_".$columnfeature],$columnfeature,'name'); 

                }

                

            }


            if($columndata['Field']=="id_customer" && ($feature=="formation")){

                if(is_string($columndata['Field'])){


                    if(checker("customer","name",$_POST['id_customer'])==1){

                        $thevalue=finder_by_Name($database,$_POST['id_customer'],"customer","id");

                    }else{

                        addValue($database,$_POST['id_customer'],"customer","name");

                        $thevalue=finder_last($database,"customer","id");


                    }


                }


                
            }

    

            if(str_contains($columndata['Field'], '_address') &&  $columndata['Field'] !="ip_address" ){


                $columnfeature=str_replace("_address","",$columndata['Field']);
                
                $thevalue=finder($database,$_POST["id_".$columnfeature],$columnfeature,'address'); 
            }



          //  if (in_array($columndata['Field'], ['hour', 'hourly_rate','cost','wage'])) {


            if($columndata['Field']=="hour" && $feature!="consulting" && $feature!="certificate"){

                $thevalue=finder($database,$_POST["id_certificate"],"certificate",$columndata['Field']); 

            }

            if($columndata['Field']=="firstname" && $feature=="formation" && $_POST["id_consulting"]==0){ 

                
                 $thevalue=$_POST['new-firstname-'.$a];

            }

            if($columndata['Field']=="surname" && $feature=="formation" && $_POST["id_consulting"]==0){ 

                
                $thevalue=$_POST['new-surname-'.$a];

           }


            if($columndata['Field']=="hourly_rate" && $feature=="formation" ){ 

                
                if($_POST["id_consulting"]!=0){


                    $thevalue=finder($database,$_POST["id_consulting"],"consulting",$columndata['Field']); 

                }else{



                    $thevalue=$_POST['new-'.$columndata['Field'].'-'.$a]; 

                }

                

            }


            if($columndata['Field']=="cost" && $feature=="formation"){

                $thevalue=finder($database,$_POST["id_certificate"],"certificate",$columndata['Field']); 

            }

            if(($columndata['Field']=="date_birth" || $columndata['Field']=="date_contrat_start" || $columndata['Field']=="date_contrat_end")  && $feature=="formation" ){



                if($_POST["id_consulting"]!=0){


                    $thevalue=finder($database,$_POST["id_consulting"],"consulting",$columndata['Field']); 


                }else{


                    $thevalue=$_POST['new-'.$columndata['Field'].'-'.$a]; 

                }


            }

            if($columndata['Field']=="actual_month"){



                $thevalue=intval(date("m"));

            }


            if($columndata['Field']=="seniority"){

                $senioritycounter=dater(strtotime($_POST['date_arrive']), strtotime(date('Y-m-d')));

                $senioritycalcul=$senioritycounter/24;

                if($senioritycalcul<1){

                    $thevalue=1;

                }else{



                    $thevalue=round($senioritycalcul);
                }


            }


            if($columndata['Field']=="address"){

                $thevalue=$_POST["number_address"]." ".$_POST["street_address"]." , ".$_POST["city_address"]." , ".$_POST["postal_address"]; 

            }


            if($columndata['Field']=="contact"){

                $thevalue=strtoupper($_POST["surname_contact"])." ".ucfirst($_POST["firstname_contact"]); 


            }


            if($columndata['Field']=="wage" ){


                $hour=finder($database,$_POST["id_certificate"],"certificate","hour"); 

                if($_POST["id_consulting"]!=0){

                    
                $hourlyrate=finder($database,$_POST["id_consulting"],"consulting","hourly_rate");


                }else{

                    $hourlyrate=$_POST['new-hourly_rate-'.$a]; 


                }


                $thevalue=selecter("dante_config","id_user",1,"directory_coef")*$hour*$hourlyrate; 

            }


            if($columndata['Field']=="amount" && $feature=="formation"){

                if($_POST["id_consulting"]!=0){

                    
                    $hourlyrate=finder($database,$_POST["id_consulting"],"consulting","hourly_rate");
    
    
                    }else{
    
                        $hourlyrate=$_POST['new-hourly_rate-'.$a]; 
    
    
                    }


                $cost=finder($database,$_POST["id_certificate"],"certificate","cost"); 

                $hour=finder($database,$_POST["id_certificate"],"certificate","hour"); 
                $wage=selecter("dante_config","id_user",1,"directory_coef")*$hour*$hourlyrate;
                $thevalue=$cost+$wage; 
           
            }


            $columns.=$virgule.$columndata['Field'];
            $values.="".$virgule."'".htmlspecialchars($thevalue)."'";

        }

            $count++;

    }
   

/*
        if (in_array($columndata['Field'], ['id_customer', 'iduser','fr_role','fr_title'])) {

                echo "";

        }else{  */


            

            $queryfinal="INSERT INTO ".$feature." (".$columns.") VALUES (".$values.")";
            executer($database,$queryfinal);

            if($feature=="formation"){
            $querycheckamount="SELECT *,SUM(amount) AS totalamount FROM formation WHERE id_formation = '".$_POST['id_formation']."' GROUP BY id_formation  ORDER BY id DESC LIMIT 1";//BAAAK

            $checkamount = $database->prepare($querycheckamount);
            $checkamount->execute();
            $checkdata = $checkamount->fetch();


            if($checkdata['totalamount']<=selecter("dante_config","id_user",1,"higher_amount")){

                    updater($database,"formation","decision",2,$checkdata['id']);

            }else{


                updater($database,"formation","decision",3,$checkdata['id']);

            }

        }
            
            if($feature=="user"){

            if($_POST['intern']==1){

            $userid=laster($database,"user","id");
            $firstname=laster($database,"user","firstname");
            $surname=laster($database,"user","surname");
            $email=laster($database,"user","email");
            $datearrive=laster($database,"user","date_arrive");
            $datebirth=laster($database,"user","date_birth");
            $role=laster($database,"user","role");
            $telephone=laster($database,"user","telephone");
            $permissions=$_POST['permission'];
            $idagency=$_POST['id_agency'];


                $senioritycounter=dater(strtotime($datearrive), strtotime(date('Y-m-d')));

                $senioritycalcul=$senioritycounter/24;

                if($senioritycalcul<1){

                    $seniority=1;

                }else{

                    $seniority=round($senioritycalcul);
                }

            $queryfinal2="INSERT INTO personal (id_user,firstname,surname,email,date_arrive,seniority,date_birth,role,telephone,permission,id_agency) VALUES (".$userid.",'".$firstname."','".$surname."','".$email."','".$datearrive."','".$seniority."','".$datebirth."','".$role."','".$telephone."','".$permissions."',".$idagency.")";
            executer($database,$queryfinal2);
        }
        }
        }


    echo "Les données ont été ajouté avec succès";

    if($feature=="user" || $feature=="formation" || $feature=="permission" ){

        if(isset($_POST['id_formation'])){

            $id=$_POST['id_formation'];

        }


        /*include "sendmail.php";*/

    }


    echo '<script>
        
            document.getElementById("sender").reset();
        
        </script>';


?>


