<tr class="the_agency"><th>Paris</th></tr>

    <?php 
   
   /*---------------------------------------------------AGENCE DE PARIS----------------------------------------------------------*/
        
   $query="SELECT * FROM personal WHERE id_agency=1";
   $request = $database->prepare($query);
   $request->execute();
   

 while($data=$request->fetch()){


    echo "<tr id='".$data['firstname']."-".$data['surname']."'>";

        for($d=0;$d<=$days;$d++){

            $result="";
            $event="work";

            if($d<10){

                $digit="0";
            }else{

                $digit="";
            }

            if($d==0){

              
                $result=strtoupper($data['surname'])." ". ucfirst($data['firstname']);
                $event="";
            }

            $dateconstruct=$year."-".$month."-".$digit.$d;

            if(isholiday(strtotime($dateconstruct))==1){

                $event="holiday";
                
            }

            if(isWeekend($dateconstruct)==1){

                $event="weekend";
            }

            if(isholiday(strtotime($dateconstruct))==0 && isWeekend(strtotime($dateconstruct))==0 && (strtotime($dateconstruct) <= strtotime(date("Y-m-d")))){
               
                if($d>0){
                    $event="presence";

                }

            }

            echo "<td id='p".$data['id']."-".$year."-".$month."-".$digit.$d."'  class='".$event."'>".$result."</td>";



        }

        /*
        $firstday=$year."-".$month."-01";

        if(isset($_POST['month'])){

            $finalmonthday=cal_days_in_month(CAL_GREGORIAN,$_POST['month'],$_POST['year']);
            $finalday=date($_POST['year']."-".$_POST['month']."-".$finalmonthday);  
              

        }else{
            $finalday=date("Y-m-d");
        }

        $lastday=dater(strtotime($firstday), strtotime($finalday)) ;
        $lastdaymonth=cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
        $lastdaymonthtowork=dater(strtotime($firstday), strtotime(date("Y-m-".$lastdaymonth)));
        $permissions=nb_permissions_month($data['id'],$year."-".$month);
        $diseases=nb_diseases_month($data['id'],$year."-".$month);
        $limitday=$lastdaymonthtowork-($permissions+$diseases);

        if($lastday>=$limitday){

            $nbpresences=$limitday;
        }else{

            $nbpresences=$lastday-($permissions+$diseases);
        }

        if(strtotime($finalday)<strtotime(date("2022-11-01"))){

            $nbpresences=0;
            $permissions=0;
            $diseases=0;

        }else{

        
*/
        ?>


<?php

        echo "<td id='perm-".$data['firstname']."-".$data['surname']."' class='permissions'></td>";
        echo "<td id='abs-".$data['firstname']."-".$data['surname']."' class='absences'></td>";
        echo "<td id='pre-".$data['firstname']."-".$data['surname']."' class='presences'></td>";
        echo "</tr>";
    }

echo "<script>";
            
/*--------Absence------------- */
$request2=selecterAll("absence");
$request2->execute();

while($data2=$request2->fetch()){

    $datestart = strtotime($data2['date_absence_start']); // or your date as well
$dateend = strtotime($data2['date_absence_end']);
$datediff = $dateend - $datestart;
$countdate=round($datediff / (60 * 60 * 24));

    for($i=0;$i<=$countdate;$i++){
        $thedate=date('Y-m-d', strtotime($data2['date_absence_start']. ' + '.$i.' days'));


        echo "if(!$('#p".$data2['id_personal']."-".$thedate."').hasClass('weekend') || $('#p".$data2['id_personal']."-".$thedate."').hasClass('holiday')){";
        echo "$('#p".$data2['id_personal']."-".$thedate."').removeAttr('class');";
        echo "$('#p".$data2['id_personal']."-".$thedate."').addClass('absence');";
        echo "}";
    }
}
/*--------Absence-------------*/


/*--------CP------------- */
$request3=selecterAlldecision("permission",1);
$request3->execute();

while($data3=$request3->fetch()){


    for($i=1;$i<=3;$i++){


        if($i==1){

            $count="";

        }else{

            $count="_".$i;
        }
        
    $datestart = strtotime($data3['date_start'.$count]); // or your date as well
$dateend = strtotime($data3['date_end'.$count]);
$datediff = $dateend - $datestart;
$countdate=round($datediff / (60 * 60 * 24));

$dc=0;

    for($a=0;$a<=$countdate;$a++){

        $thedate=date('Y-m-d', strtotime($data3['date_start'.$count]. ' + '.$a.' days'));

        if(isWeekend($thedate)!=1){

            $dc++;
        }


        echo "if(!$('#p".$data3['id_personal']."-".$thedate."').hasClass('weekend') || $('#p".$data3['id_personal']."-".$thedate."').hasClass('holiday')){";

        if(($dc<=$data3['paid'] && $data3['paid']!=0  || $data3['reason']=="nopaid" || $data3['reason']!="anticipated" && $data3['left_permission']<=0) && $data3['reason']!="family" ){

            echo "$('#p".$data3['id_personal']."-".$thedate."').removeAttr('class');";
            echo "$('#p".$data3['id_personal']."-".$thedate."').addClass('absence');";

        }else{

            if($data3['reason']=="family"){

                echo "$('#p".$data3['id_personal']."-".$thedate."').removeAttr('class');";
              
                echo "$('#p".$data3['id_personal']."-".$thedate."').addClass('presence');";
                echo "$('#p".$data3['id_personal']."-".$thedate."').addClass('family');";

            }else{
            echo "$('#p".$data3['id_personal']."-".$thedate."').removeAttr('class');";
            echo "$('#p".$data3['id_personal']."-".$thedate."').addClass('permission');";
            }
        }

        echo "}";
        
    }

}


}
/*--------CP-------------*/


/*--------CP EN ATTENTE------------- */
$request3=selecterAlldecision("permission",2);
$request3->execute();

while($data3=$request3->fetch()){


    for($i=1;$i<=3;$i++){


        if($i==1){

            $count="";

        }else{

            $count="_".$i;
        }
        
    $datestart = strtotime($data3['date_start'.$count]); // or your date as well
$dateend = strtotime($data3['date_end'.$count]);
$datediff = $dateend - $datestart;
$countdate=round($datediff / (60 * 60 * 24));

    for($a=0;$a<=$countdate;$a++){

        $thedate=date('Y-m-d', strtotime($data3['date_start'.$count]. ' + '.$a.' days'));

        echo "if(!$('#p".$data3['id_personal']."-".$thedate."').hasClass('weekend') || $('#p".$data3['id_personal']."-".$thedate."').hasClass('holiday')  ){";
       
        echo "$('#p".$data3['id_personal']."-".$thedate."').addClass('permissionwait');";

        echo "}";
        
    }

}


}
/*--------CP-------------*/

echo "</script>";


           /*---------------------------------------------------AGENCE DE PARIS----------------------------------------------------------*/
        ?>

<script>
    

<?php

$request2 = $database->prepare($query);
$request2->execute();
$i=1;
while($data=$request2->fetch()){

?>


var presence<?php echo $i?>=$( "#<?php echo $data['firstname']."-".$data['surname']; ?> > .presence" ).length;
$('<?php echo "#pre-".$data['firstname']."-".$data['surname']; ?>').html(presence<?php echo $i?>);

var permission<?php echo $i?>=$( "#<?php echo $data['firstname']."-".$data['surname']; ?> > .permission" ).length;
$('<?php echo "#perm-".$data['firstname']."-".$data['surname']; ?>').html(permission<?php echo $i?>);

var absence<?php echo $i?>=$( "#<?php echo $data['firstname']."-".$data['surname']; ?> > .absence" ).length;
$('<?php echo "#abs-".$data['firstname']."-".$data['surname']; ?>').html(absence<?php echo $i?>);

<?php $i++;  }  ?>


</script>