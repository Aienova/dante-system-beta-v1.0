
<div id="loaderfeature"></div>
<?php


include_once("database.php");
include_once("functions.php");

?>

<style>
    #addtofeature{

        display:none;
    }
    </style>

 <a id="printfeature" class="print-calendar" onclick="print_Calendar();"><div class="navigate" style="width: fit-content;"> <img class="pictos" src="build/media/icons/print.png"><span class="featurespan">Imprimer le calendrier</span></div></a>
<h2>Calendrier</h2>

<div class="flexible">

<legend>
<h3>Légendes</h3>
<strong style="color:#51a5ff; ">Bleu:</strong>Jour de présence<br>
<strong style="color:red;">Rouge:</strong> Jour d'absence / maladie<br>
<strong style="color:orange;">Orange:</strong> Demande de congés en cours de validation<br>
<strong style="color:#19c56e; ">Vert:</strong> Demande de congés validée<br>
<strong style="color:#f2e95f; ">Jaune:</strong> Jour férié<br>
<strong style="color:grey;">Gris:</strong> Weekend<br>
</legend>

<form id="sender" data-action="calendar" class="calendarsearch" method="POST" action="">


<label>Mois :</label>
        <select name="month">

        <?php   
        
        for($i=1;$i<=12;$i++){

            if($i<10){

                $digit="0";
            }else{

                $digit="";
            }

            $month=$digit.$i;

            $selected="";


           

            
            if(isset($_POST['month'])){

                $digit2="";

                if($_POST['month']<10){

                    $digit2="0";
                }

                if($month==$digit2.$_POST['month']){

                    echo $_POST['month'];
                    $selected="selected";
                }
          
            }else{

                if($month==date("m")){
                    $selected="selected";
                }
            }


            include "fr_month.php";


        echo '<option value="'.$i.'"  '.$selected.'>'.$monthname.'</option>';

        }
        
        ?>


              </select><br><br>
              <label>Année :</label>
              <select name="year">

              <?php   
        
        for($i=1;$i<=5;$i++){

            $year=2021+$i;

            $selected="";


            
            if(isset($_POST['year'])){

             
                if($year==$_POST['year']){

                    $selected="selected";
                }
          
            }else{

                if($month==intval(date("Y"))){
                    $selected="selected";
                }
            }


            include "fr_month.php";

        echo '<option value="'.$year.'"  '.$selected.'>'.$year.'</option>';

        }
        

        ?>

    
              </select>
              
                <br>

              <input type="submit" value="Regarder à cette période">


    </form>

</div>

<div id="calendar">


<?php
        if(isset($_POST['month'])){

        $month=$_POST['month'];

        }else{

            $month=date('m');

        }

        $dgit="";

        if(intval($month)<10){

            $dgit="0";

            $month=$dgit.$month;
        }


        if(isset($_POST['year'])){

            $year=$_POST['year'];
    
            }else{
    
                $year=date('Y');

                


            }

?>

<table style="background-color: #ffffff78;">
    <thead>
        <tr><th><?php 
        
        include "fr_month.php";

        echo $monthname." ".$year;  
        
        
        
        ?></th><tr>

        <tr>



            
        <?php 


        $days=cal_days_in_month(CAL_GREGORIAN,$month,$year);
      

        for($d=0;$d<=$days;$d++){

            $columname="";
            $result=$d;

            if($d==0){

                $columname="Salariés";
                $result=$columname;
            }


            echo "<td>".$result."</td>";

        }

        echo "<td class='permissions'>CP</td>";
        echo "<td class='absences'>A/M</td>";
        echo "<td class='presences'>PR</td>";
    
        
        ?>
        
    </tr>

    </thead>

    <tbody>

        <?php  include "calendar_paris.php" ?>
        <?php include "calendar_toulouse.php"  ?>

    </tbody>

</table>
    </div>

</div>

<?php  include "script.php" ?>

<script>


function print_Calendar() {
    PrintElem("#calendar");
}

function PrintElem(elem) {
    Popup($(elem).html());
}


function Popup(data) {
      var mywindow = window.open('', 'new div', 'height=900,width=900');
      mywindow.document.write('<html><head><title></title>');
      mywindow.document.write('<link rel="stylesheet" href="../build/app.css" type="text/css" />');
      mywindow.document.write('</head><body style="background-color:white; background-image:none;" >');
      mywindow.document.write(data);
      mywindow.document.write('</body></html>');
      mywindow.document.close();
      mywindow.focus();
      setTimeout(function(){mywindow.print();},1000);


      return true;
}


</script>

