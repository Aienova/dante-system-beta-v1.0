<style>


.permission {

background-image: url(./build/media/images/permission_fr.png);
background-size:cover;

}


</style>


<?php


include_once("database.php");
include_once("functions.php");



class Calendar {

    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    public function add_event($txt, $date, $days = 1, $color = '') {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color];
    }



    public function __toString() {

        $datadate=$this->active_month."-".$this->active_day."-".$this->active_year;
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        
        $monthname=date('F', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $theyear=date('Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        

        include "fr_month.php";

        $html .= $monthname." ".$theyear;
        $html .= '</div>';
        $html .= '</div>';


        $html .= '<div class="days">';
        foreach ($days as $day) {

            $dayfr=$day;

            if($day=='Sun'){$dayfr='Dimanche';}
            if($day=='Mon'){$dayfr='Lundi';}
            if($day=='Tue'){$dayfr='Mardi';}
            if($day=='Wed'){$dayfr='Mercredi';}
            if($day=='Thu'){$dayfr='Jeudi';}
            if($day=='Fri'){$dayfr='Vendredi';}
            if($day=='Sat'){$dayfr='Samedi';}

            $html .= '
                <div class="day_name">
                    ' . $dayfr . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }

        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->active_day) {
                $selected = ' selected';
            }

            if(isset($_POST['permission'])){

                if($i<10){

                    $digit="0";

                }else{

                    $digit='';
                }


                $thedate=$this->active_year."-".$this->active_month."-".$digit.$i;
                $permission=checkPermission($_POST['idpersonal'],$thedate);

            }else{

                $permission="";
            }

            
            $html .= '<div id="date-'.$this->active_year."-".$this->active_month."-".$i.'" data-date="'.$this->active_month."-".$i."-".$this->active_year.'" class="day_num' . $selected ." ".$permission. '">';
            $html .= '<span>' . $i . '</span>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event' . $event[3] . '">';
                        $html .= $event[0];
                        $html .= '</div>';
                    }
                }
            }
            $html .= isholiday($i,$this->active_month).'</div>';
        }


        
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div  class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

}

if(isset($_POST['searchdate']) || isset($_POST['permission'] ) ){

    echo $_POST['searchdate'];

    if(isset($_POST['permission'])){

        echo "<br><strong>Congé du salarié :".finder($database,$_POST['idpersonal'],"personal","firstname")." ".finder($database,$_POST['idpersonal'],"personal","surname")."</strong>";


        
    }


    $calendar = new Calendar($_POST['searchdate']);
    $currentdate = $_POST['searchdate'];

}else{

    $calendar = new Calendar();
    $currentdate=date("Y-m-d");
   

}



echo "<div id='searchpersonal'><label>Sélectionnez les disponibilités du salarié :</label><br>".Radio_Lister("Choisir le salarié ",$database,"personal",$currentdate)."</div>";

echo $calendar;

echo "<div id='permissions'></div>";



?>

<script>

$("#searchdate").removeClass("hidden");

$("#addtofeature").addClass("hidden");

var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}


$(".radiothis").click(function() {


console.log("radio");


var id = $(this).closest(".radiothis").attr("data-id");
var currentdate = $(this).closest(".radiothis").attr("data-date");

$.ajax({
  url: "./functions/calendar.php",
  type: "POST",
  data: { idpersonal : id ,
          permission : "permission",
          searchdate : currentdate,

  },



  success: function(data) {


      $("#feature").html(data);


     },
     error: function() {
      $("#feature").text("Erreur au niveau des fonctions");
     }


});






});

</script>