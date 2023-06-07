<?php   


echo "body{background-color:white!important;-webkit-print-color-adjust: exact;-moz-print-color-adjust: exact;-ms-print-color-adjust: exact;print-color-adjust: exact;}";



/*--------Présence-------------

$request=selecterAll("personal");
$request->execute();

while($data=$request->fetch()){

    $today=intval(date("d"));

    for($x=1;$x<=$today;$x++){

        if($x<10){

            $digit="0";
        }else{

            $digit="";
        }

        $day=$digit.$x;

        echo "#p".$data['id']."-".date("Y")."-".date("m")."-".$day."{background-color:#51a5ff;}";
    }

}

--------Présence-------------*/







/*--------Congé-------------


$request=selecterAll("permission");
$request->execute();


while($data=$request->fetch()){


    $datestart = strtotime($data['date_start']); // or your date as well
$dateend = strtotime($data['date_end']);
$datediff = $dateend - $datestart;
$countdate=round($datediff / (60 * 60 * 24));

    for($i=0;$i<=$countdate;$i++){


        $thedate=date('Y-m-d', strtotime($data['date_start']. ' + '.$i.' days'));
    echo "#p".$data['id_personal']."-".$thedate."{background-color: #19c46e;}";


    }
}

/*---------Congé-----------*/




?>