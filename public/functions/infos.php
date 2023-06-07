

<strong>Solde congé N-1 : <span style="color:#bbfe00">0</span></strong>
        <strong>Solde congé N : 
         <span id="leavecount" style="color:#bbfe00">



         <?php


include "database.php";
include 'functions.php';


$serial = fopen("../alighieri.txt", "w") or die("Unable to open file!");
$dante_ip=file_get_contents("../connections/user".$_SESSION["user"].".txt");


$iduser=selecter("user","ip_address",$dante_ip,"id");

$idpersonal=selecter("personal","id_user",$iduser,"id");

$datearrive=selecter("personal","id_user",$iduser,"date_arrive");

$seniority=selecter("personal","id_user",$iduser,"seniority");

$actual_month=selecter("user","id",$iduser,"actual_month");

$permission=selecter("personal","id_user",$iduser,"permission");

$check_month=intval(date("m"));



if($check_month != $actual_month){

   $actual_month=$check_month;
   EditValue("user","actual_month",$actual_month,0,$iduser);

   $permissioncounter=dater(strtotime($datearrive), strtotime(date('Y-m-d')));

   if($permissioncounter%24==0 || round($permissioncounter/$seniority)>=24){

      
      $seniority++;

      $permission=$permission+2.085;
      
      EditValue("personal","permission",$permission,0,$idpersonal);
      EditValue("personal","seniority",$seniority,0,$idpersonal);
      


   }

}










    
   echo  $permission;





?>




         </span>
      
      </strong>


        <strong style='text-align:left; margin-left:5px;'>Niveau : 
        
        
        
        
        <span id="userlevel" style="color:#bbfe00">
        
        <?php
      
        $dante_ip=file_get_contents("../connections/user".$_SESSION["user"].".txt");


$idlevel=selecter("user","id",$iduser,"level");

$levelname=selecter("level","id",$idlevel,"level_".$lang);


   echo  $levelname;


      ?>


        </span></strong>
        



        <?php echo "<div id='levelsetting'>"; include 'level.php'; echo "</div>";  ?>



