
<?php


include_once("database.php");
include_once("functions.php");


    $feature=$_POST['featurename'];
    $id=$_POST['featureid'];
    $value=$_POST['valuename'];
    $result=$_POST['setvalue'];
    $featuremessage=$_POST['featuremessage'];


    
    $mkdirmessage="";

    if(isset($_POST['excuses'])){



        $excuses=str_replace("'","&#039",$_POST['excuses']);

        EditValue($feature,"excuses","'".$excuses."'",0,$id);
    
    }




    if(isset($_POST['quantity'])){


        $quantity=$_POST['quantity'];

    }else{

        $quantity=0;
    }


    EditValue($feature,$value,$result,$quantity,$id);



    if($result==2){

        EditValue($feature,"validator",'"'.the_username().'"',0,$id);
        EditValue($feature,"date_decision",'"'.date("Y-m-d").'"',0,$id);
        $mailtype=1;

       /* include "sendmail.php"; */
        
    }
    

    

    if($feature=="formation"){

        EditValue("formation","id_user",the_iduser(),0,$id);

        $mkdirmessage="";

        if($result==1){

        EditValue("formation","validator",'"'.the_username().'"',0,$id);
        EditValue("formation","date_decision",'"'.date("Y-m-d").'"',0,$id);

                        /*------------------Folder Generator---------------------------*/


                        $child=$id;

                        
                
                        Makedir($child,$id); 
            

                        $mkdirmessage="Le Dossier ".$child." a été créé";
                        
            
                    /*--------------------------Folder Generator-----------------------------*/
        


                    $mailtype=2;
              /*      include "sendmail.php"; */



        }

    }


        if($feature=="permission"){


            if($result==1){

                EditValue($feature,"validator",'"'.the_username().'"',0,$id);
                EditValue($feature,"date_decision",'"'.date("Y-m-d").'"',0,$id);

            $mailtype=2;
         /*   include "sendmail.php"; */

            }


        }


        if($result==0){

            EditValue($feature,"validator",'"'.the_username().'"',0,$id);
            EditValue($feature,"date_decision",'"'.date("Y-m-d").'"',0,$id);
            
            $mailtype=3;
           /* include "sendmail.php"; */
        }



    if($result==1 && $feature=="permission"){

        $id=selecter("permission","id_permission",$id,"id");
        $idpersonal=finder($database,$id,$feature,"id_personal");
        $nbpermission_personal=finder($database,$idpersonal,"personal","permission");
        

        $permission=$nbpermission_personal-(finder($database,$id,$feature,"total_count_permission"));
        
        EditValue("personal","permission",$permission,0,$idpersonal);


    }

    echo $featuremessage."<br>";
    echo $mkdirmessage;


?>


