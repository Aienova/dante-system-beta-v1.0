

<?php

include "database.php";
include 'functions.php';






        /**  CHECK LOGIN PASSWORD */
    if(isset($_POST['userconnect']) ){


        function generateRandomString() {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 7; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        
        $txt = $_POST['userconnect'].generateRandomString();

     
        $dante_ip=md5('96'.strrev(gethostname().'19'.$_SERVER['REMOTE_ADDR'].'92')).$txt;



        $login=checker("user","login",$_POST['userconnect']);

        if($login==0){

            echo "Connexion échoué : login non existant";
            exit;


        }


        $checking=double_checker("user","login",$_POST['userconnect'],"password",$_POST['userpassword']);

        

        /**  CHECK LOGIN PASSWORD */
    if($checking==1){


        for($i=1;$i<=21;$i++){


            $ipcheck=file_get_contents("../connections/user".$i.".txt");


            if($i==21){

                echo "Vous avez atteint la limite de connexion";exit;

            }


            if(str_contains($ipcheck, $_POST['userconnect']) ){

                $userfile=$i;break;

            }


            if(filesize("../connections/user".$i.".txt")==0){

                $userfile=$i;break;

            }

        }


            


         
            
            
          


        

        $userid=selecter("user","login",$_POST['userconnect'],"id");

        echo "Connexion réussie";
        activated($userid);


 


      
        file_put_contents("../connections/user".$userfile.".txt", $dante_ip);



       // file_get_contents("../connections/user1.txt");

        userip($userid,$dante_ip);

      

        $_SESSION["user"]=$userfile;

        echo "<script>
        
        setTimeout(function() {

            window.location.replace('/?user=".$userfile."');
            
            
            },2500);
       
        
        
        
        </script>";
    





    }else{

        echo "Connexion échoué : mot de passe invalide";

    }



    }
    

    
    else{



      
 

        $dante_ip=file_get_contents("../connections/user".$_SESSION["user"].".txt");

            $activity=isactive($dante_ip);


            if($activity==1){

                
                /*---  YOU ARE CONNECTED --*/
                

            }else{

                

                unset($_SESSION["user"]);

               echo "<script>window.location.replace('/connection');</script>"; 
               


            }


          
                
                
               


    }
        
        





/*
    echo "<script>window.location.replace('/connection');</script>"; */





?>

