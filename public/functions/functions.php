
<?php


session_start();

 

function debugger($value){


    echo '<h1 id="debug">'.$value.'</h1>';
}


function showrequest($request){


    echo 'alert('.$request.')';



}


function generateidCode($feature){

                if($feature=="bill"){ $prefix="FAC"; }
                if($feature=="formation"){ $prefix="FRM"; }
                if($feature=="quotation"){ $prefix="DEV"; }
                if($feature=="permission"){ $prefix="CON"; }
                if($feature=="institute"){ $prefix="ORG"; }
                if($feature=="certificate"){ $prefix="CER"; }
                if($feature=="licence"){ $prefix="LIC"; }
                if($feature=="cv"){ $prefix="CV"; }

                $code=$prefix."-".date('Ymd')."-".rand(100, 999);

                return $code;


}



function the_iduser(){

    
    $dante_ip=file_get_contents("../connections/user".$_SESSION["user"].".txt");
    
    $iduser=selecter("user","ip_address",$dante_ip,"id");

    return $iduser;

}


function the_level(){

$level=selecter("user","id",the_iduser(),"level");

return $level;

}

function the_idpersonal(){

    

    $idperosnal=selecter("personal","id_user",the_iduser(),"id");

    return $idperosnal;

}

function the_username(){

    $username=selecter("user","id",the_iduser(),"firstname")." ".selecter("user","id",the_iduser(),"surname");

    return $username;

}


function fetcher($database,$query){


    $request = $database->prepare($query);
            $request->execute();
            return $data=$request->fetch();
}





function laster($database,$feature,$column){

    $query="SELECT * FROM $feature ORDER BY id DESC LIMIT 1";

    $request = $database->prepare($query);
            $request->execute();
            $data=$request->fetch();
           
            return $data[$column];
            
}





function finder_by_Name($database,$id,$feature,$column){

    $query="SELECT * FROM $feature WHERE name LIKE '%".$id."%'";
    $request = $database->prepare($query);
            $request->execute();
            $data=$request->fetch();
            return $data[$column];
}


function finder_last($database,$feature,$column){


    $query="SELECT * FROM $feature ORDER BY id DESC";
    $request = $database->prepare($query);
    $request->execute();
    $data=$request->fetch();
    return $data[$column];

}

function finder($database,$id,$feature,$column){

    if($id!=0){
    $query="SELECT * FROM $feature WHERE id=$id";
    $request = $database->prepare($query);
            $request->execute();
            $data=$request->fetch();
            return $data[$column];
    }
            
}


function updater($database,$feature,$column,$value,$id){

    $query="UPDATE ".$feature." SET ".$column."='".$value."' WHERE id=".$id;

    $request = $database->prepare($query);
            $request->execute();
           
            
}




function finder_personal_id($database,$id){

    $query="SELECT * FROM personal WHERE id_user=$id ";

    $request = $database->prepare($query);
            $request->execute();
            $data=$request->fetch();
           
        
            return $data['id'];
            
}

function Lister_interns($database,$idformation){



    $query="SELECT * FROM formation WHERE id_formation='".$idformation."'";


    $request = $database->prepare($query);
            $request->execute();

            $result="";
            while ($data=$request->fetch()){



                    $dataname=$data['consulting_name'];
                
                $result.="<span data-id='".$data['id']."' class='opening'>".$dataname."</span><br><br>";
            }

            return $result;
           
        
}



    function Data_Lister($database,$feature){


        /*---SQL EXEMPLE : SELECT *, customer.id as cusomertid FROM formation INNER JOIN customer ON formation.id_customer = customer.id; */
    
        $where="";
    
    
        if($feature=="institute"){
    
            $where=" WHERE licence=1";
        }
    
        $query="SELECT * FROM ".$feature.$where;
    
    
        $request = $database->prepare($query);
                $request->execute();
    
    
                $result="";
    
    
                while ($data=$request->fetch()){
    
    
                    if(isset($data['name'])){
    
    
    
                        if($feature=="certificate"){
    
                            $dataname=$data['name']." - ".$data['cost']."€ -".$data['hour']."h";
    
                        }else{
    
                            $dataname=$data['name'];
    
                        }
     
                        
    
                    }else{
    
                        $dataname=$data['firstname']." ".$data['surname'];
                    }
    
    
                    $result.="<option data-table='".$feature."' value='".$dataname."'>".$dataname."</option>";
    
                  
    
                }


       
    
                return $result;
               
            
    }


    function Lister_selected($database,$feature,$select){

        /*---SQL EXEMPLE : SELECT *, customer.id as cusomertid FROM formation INNER JOIN customer ON formation.id_customer = customer.id; */
    
        $where="";
        $value="";
    
        if($feature=="institute"){
    
            $where=" WHERE licence=1";
        }
    
        if($feature=="level"){
    
            $where=" WHERE NOT id=0";
        }

    
        $query="SELECT * FROM ".$feature.$where;
    
        $request = $database->prepare($query);
                $request->execute();
    
                $result="";
    
                while ($data=$request->fetch()){

                    $selected="";

                    

        if($feature=="quotation"){

            $value=$data["id_".$feature];


        }else{

            $value=$data["id"];

        }

                    
                    if($select==$data['id']){

                        $selected="selected";
                    }
    
    
                    if(isset($data['name'])){
    
    
                        if($feature=="certificate"){
    
                            $dataname=$data['name']." - ".$data['cost']."€ -".$data['hour']."h";
    
                        }else{
    
                            $dataname=$data['name'];
    
                        }
    
                        $result.="<option data-table='".$feature."' data-name='".$dataname."' value='".$value."' ".$selected.">".$dataname."</option>";
     
                    }else{
    
                        if(isset($data['level_fr'])){
    
                            $result.="<option  value='".$value."'" .$selected.">".$data['level_fr']."</option>";
            
                        }else{
    
                        $dataname=strtoupper($data['surname'])." ".ucfirst($data['firstname']);
                            $result.="<option data-table='".$feature."' data-name='".$dataname."' value='".$value."' ".$selected.">".$dataname."</option>";
    
                        }
    
                    }
    
                }
                return $result;
    }
    

    function Lister($database,$feature){

    /*---SQL EXEMPLE : SELECT *, customer.id as cusomertid FROM formation INNER JOIN customer ON formation.id_customer = customer.id; */

    $where="";



    if($feature=="institute"){

        $where=" WHERE licence=1";
    }

    if($feature=="level"){

        $where=" WHERE NOT id=0";
    }

    $query="SELECT * FROM ".$feature.$where;


    $request = $database->prepare($query);
            $request->execute();


            $result="";


            while ($data=$request->fetch()){


                if(isset($data['name'])){

                    $datahour="";

                    if($feature=="certificate"){

                        $dataname=$data['name']."-".$data['hour']."h";
                        $datahour="data-hour='".$data['hour']."'";

                    }else{

                        $dataname=$data['name'];

                    }


                    $result.="<option data-table='".$feature."' data-name='".$dataname."'  ".$datahour." value='".$data['id']."' >".$dataname."</option>";
 
                }else{

                    if(isset($data['level_fr'])){

                        $result.="<option  value='".$data['id']."'>".$data['level_fr']."</option>";
        
                    }else{

                    $dataname=strtoupper($data['surname'])." ".ucfirst($data['firstname']);
                        
                    $result.="<option data-table='".$feature."' data-name='".$dataname."' value='".$data['id']."' >".$dataname."</option>";

                    }

                }

            }

        
            return $result;
           
}


function Uppercaser($word){

    $result="<span style='text-transform:uppercase'>".$word."</span>";

    return $result;

}


function Capitalizer($word){

    $result="<span style='text-transform:capitalize'>".$word."</span>";

    return $result;

}


function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}


function Radio_Lister($message,$database,$feature,$currentdate){

    $multilist= '<div id="'.$feature.'" class="multiselect"><div class="selectBox" onclick="showCheckboxes()">
        <select>
          <option>'.$message.'</option>
        </select>
        <div class="overSelect"></div>
      </div>
      <div id="checkboxes">';
  
      if($feature=='personal'){
  
          $nametype="surname";
          $where="";
  
  
      }
      
      
      
      else{
  
          $nametype="name";
          $where="";
  
      }
  
  
      
  
      $query="SELECT * FROM ".$feature.$where." ORDER BY $nametype ";
  
  
      $request = $database->prepare($query);
              $request->execute();
  
              $options='';
          
              while ($data=$request->fetch()){
  
                  
                  if(isset($data['name'])){
  
                      $dataname=$data['name'];
                  }else{
  
                      $dataname=$data['firstname']." ".$data['surname'];
                  }
  
            
      $options.='<label for="'.$feature.'-'.$data['id'].'"><input class="radiothis" type="radio" name="" data-date="'.$currentdate.'"  data-id="'.$data['id'].'" data-feature="'.$feature.'"  id="'.$feature.'-'.$data['id'].'" value="'.$data['id'].'" />'.$dataname.'</label>';
  
              }
  

              if($options==""){
  
                  $options="<label>Aucun salarié présent</label>";
              }
  
  
     return $multilist.$options.'</div> </div>';
  
  
  
      /*---SQL EXEMPLE : SELECT *, customer.id as cusomertid FROM formation INNER JOIN customer ON formation.id_customer = customer.id; */
  /*
      $query="SELECT * FROM ".$feature." INNER JOIN ".$joinner." ON ".$feature.".id_".$joinner." = ".$joinner.".id;";
  
  
      $request = $database->prepare($query);
              $request->execute();
              while ($data=$request->fetch()){
  
                  $respond=."<option>".."</option>";
  
              }
             
          
              return $respond;
              */
  }
  



function Multi_Lister($message,$database,$feature,$relation){

  $multilist= '<div id="'.$feature.'" class="multiselect"><div class="selectBox" onclick="showCheckboxes()">
      <select>
        <option>'.$message.'</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div id="checkboxes">';

    if($feature=='consulting'){

        if($relation==0){

            $and="";
        }else{

            $and=" AND id_customer=".$relation;
        }

        $nametype="surname";
        $where=" WHERE state_consulting=1".$and;


    }else{

        $nametype="name";
        $where="";

    }


    

    $query="SELECT * FROM ".$feature.$where." ORDER BY $nametype ";


    $request = $database->prepare($query);
            $request->execute();

            $options='';
        
            while ($data=$request->fetch()){

                
                if(isset($data['name'])){

                    $dataname="<span style='text-transform:capitalize;'>".$data['name']."</span>";
                }else{

                    $dataname="<span style='text-transform:uppercase;'>".$data['surname']."</span> <span style='text-transform:capitalize;margin-left:5px;'>".$data['firstname']."</span>";
                }

          


    $options.='<label for="'.$feature.'-'.$data['id'].'"><input class="checkthis" type="checkbox" name=""  data-id="'.$data['id'].'" data-feature="'.$feature.'"  id="'.$feature.'-'.$data['id'].'" value="'.$data['id'].'" />'.$dataname.'</label>';

            }



            $nb="
            
            <input id='counter' type='hidden' name='nb_".$feature."' value='0' />"
            
            
            ;

            if($options==""){

                
                $options="<a href='/consulting'><label>Aucun intérimaires disponibles, cliquez-ici pour les ajouter</label></a>";
            }


   return $multilist.$options.$nb.'</div> </div>';



    /*---SQL EXEMPLE : SELECT *, customer.id as cusomertid FROM formation INNER JOIN customer ON formation.id_customer = customer.id; */
/*
    $query="SELECT * FROM ".$feature." INNER JOIN ".$joinner." ON ".$feature.".id_".$joinner." = ".$joinner.".id;";


    $request = $database->prepare($query);
            $request->execute();
            while ($data=$request->fetch()){

                $respond=."<option>".."</option>";

            }
           
        
            return $respond;
            */
}

function isholiday($timestamp)
{
$jour = date("d", $timestamp);
$mois = date("m", $timestamp);
$annee = date("Y", $timestamp);
$EstFerie = 0;
// dates fériées fixes
if($jour == 1 && $mois == 1) $EstFerie = 1; // 1er janvier
if($jour == 1 && $mois == 5) $EstFerie = 1; // 1er mai
if($jour == 8 && $mois == 5) $EstFerie = 1; // 8 mai
if($jour == 14 && $mois == 7) $EstFerie = 1; // 14 juillet
if($jour == 15 && $mois == 8) $EstFerie = 1; // 15 aout
if($jour == 1 && $mois == 11) $EstFerie = 1; // 1 novembre
if($jour == 11 && $mois == 11) $EstFerie = 1; // 11 novembre
if($jour == 25 && $mois == 12) $EstFerie = 1; // 25 décembre
// fetes religieuses mobiles
$pak = easter_date($annee);
$jp = date("d", $pak);
$mp = date("m", $pak);
if($jp == $jour && $mp == $mois){ $EstFerie = 1;} // Pâques
$lpk = mktime(date("H", $pak), date("i", $pak), date("s", $pak), date("m", $pak)
, date("d", $pak) +1, date("Y", $pak) );
$jp = date("d", $lpk);
$mp = date("m", $lpk);
if($jp == $jour && $mp == $mois){ $EstFerie = 1; }// Lundi de Pâques
$asc = mktime(date("H", $pak), date("i", $pak), date("s", $pak), date("m", $pak)
, date("d", $pak) + 39, date("Y", $pak) );
$jp = date("d", $asc);
$mp = date("m", $asc);
if($jp == $jour && $mp == $mois){ $EstFerie = 1;}//ascension
$pe = mktime(date("H", $pak), date("i", $pak), date("s", $pak), date("m", $pak),
 date("d", $pak) + 49, date("Y", $pak) );
$jp = date("d", $pe);
$mp = date("m", $pe);
if($jp == $jour && $mp == $mois) {$EstFerie = 1;}// Pentecôte
$lp = mktime(date("H", $asc), date("i", $pak), date("s", $pak), date("m", $pak),
 date("d", $pak) + 50, date("Y", $pak) );
$jp = date("d", $lp);
$mp = date("m", $lp);
if($jp == $jour && $mp == $mois) {$EstFerie = 1;}// lundi Pentecôte
// Samedis et dimanches
$jour_sem = jddayofweek(unixtojd($timestamp), 0);
if($jour_sem == 0 || $jour_sem == 6) $EstFerie = 1;
// ces deux lignes au dessus sont à retirer si vous ne désirez pas faire
// apparaitre les
// samedis et dimanches comme fériés.
return $EstFerie;
}

/*
function isholiday($day,$month){

    include "database.php";

    $query="SELECT * FROM holiday_".$lang." WHERE day='$day' AND month='$month' ";

    $request = $database->prepare($query);
            $request->execute();

            $count = $request->rowCount();


            if($count>0){

                
            $data=$request->fetch();
           
   
            return $data["event_code"];

            
            }else{

                return NULL;
            }


            
}
*/


function checkPermission($id,$thedate){



    include "database.php";

    $query="SELECT * FROM permission WHERE id_personal =".selecter("personal","id_user",$id,"id")." AND decision=1 AND date_start <= '".date($thedate)."' AND date_end >='".date($thedate)."' ";

    $request = $database->prepare($query);
    $request->execute();
    $count = $request->rowCount();
    $data=$request->fetch();

    
    if($count!=0){

        $result="permission";

        

    }else{

        $result="";

    }


    return $result;

    






}

function checkRendezvous($id,$thedate){


    include "database.php";

    $query="SELECT * FROM rendez_vous WHERE id_user =".$id." AND date_selected ='".$thedate."'";


    $request = $database->prepare($query);
    $request->execute();
    $count = $request->rowCount();
    $data=$request->fetch();

    
    if($count!=0){

        $result="rendez_vous";

        

    }else{

        $result="";

    }


    return $result;

    






}



function isWeekend($date) {

        $date1 = strtotime($date);
        $date2 = date("l", $date1);
        $date3 = strtolower($date2);
    if(($date3 == "saturday" )|| ($date3 == "sunday"))
		{
            return 1;
        } 
    else
		{
            return 0;
        }
}

function dater($date_start, $date_stop) {	
	$arr_bank_holidays = array(); // Tableau des jours feriés	
	
	// On boucle dans le cas où l'année de départ serait différente de l'année d'arrivée
	$diff_year = date('Y', $date_stop) - date('Y', $date_start);
	for ($i = 0; $i <= $diff_year; $i++) {			
		$year = (int)date('Y', $date_start) + $i;
		// Liste des jours feriés
		$arr_bank_holidays[] = '1_1_'.$year; // Jour de l'an
		$arr_bank_holidays[] = '1_5_'.$year; // Fete du travail
		$arr_bank_holidays[] = '8_5_'.$year; // Victoire 1945
		$arr_bank_holidays[] = '14_7_'.$year; // Fete nationale
		$arr_bank_holidays[] = '15_8_'.$year; // Assomption
		$arr_bank_holidays[] = '1_11_'.$year; // Toussaint
		$arr_bank_holidays[] = '11_11_'.$year; // Armistice 1918
		$arr_bank_holidays[] = '25_12_'.$year; // Noel
				
		// Récupération de paques. Permet ensuite d'obtenir le jour de l'ascension et celui de la pentecote	
		$easter = easter_date($year);
		$arr_bank_holidays[] = date('j_n_'.$year, $easter + 86400); // Paques
		$arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*39)); // Ascension
		$arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*50)); // Pentecote	
	}
	//print_r($arr_bank_holidays);
	$nb_days_open = 1;
	// Mettre <= si on souhaite prendre en compte le dernier jour dans le décompte	
	while ($date_start < $date_stop) {
		// Si le jour suivant n'est ni un dimanche (0) ou un samedi (6), ni un jour férié, on incrémente les jours ouvrés	
		if (!in_array(date('w', $date_start), array(0, 6)) 
		&& !in_array(date('j_n_'.date('Y', $date_start), $date_start), $arr_bank_holidays)) {
			$nb_days_open++;		
		}
		$date_start = mktime(date('H', $date_start), date('i', $date_start), date('s', $date_start), date('m', $date_start), date('d', $date_start) + 1, date('Y', $date_start));			
	}		


	return $nb_days_open-isWeekend(date('Y-m-d', $date_stop));

}


function executer($database,$query){

    
    $request = $database->prepare($query);
           return $request->execute();
            
}

function addValue($database,$value,$feature,$column){
    
    $query="INSERT INTO ".$feature."(".$column.") VALUES('".$value."')";
    $request = $database->prepare($query);
    $request->execute();
}

function counter($database,$query){


    $request = $database->prepare($query);
    $request->execute();
    return $request->rowCount();
}

function checker($table,$column,$value){

    include "database.php";

    $query="SELECT * FROM ".$table." WHERE ".$column."='".$value."'";
    
    $request = $database->prepare($query);
    $request->execute();
    $count = $request->rowCount();

 
    return $count;

}


function double_checker($table,$column1,$value1,$column2,$value2){

    include "database.php";

    $query="SELECT * FROM ".$table." WHERE ".$column1."='".$value1."' AND ".$column2."='".$value2."' ";

    $request = $database->prepare($query);
    $request->execute();
    $count = $request->rowCount();


 
    return $count;

}


function stat_count($table){

    include "database.php";

    $query="SELECT * FROM ".$table;
    $request = $database->prepare($query);
    $request->execute();
    $count = $request->rowCount();

    return $count;

}



function Top($table,$column,$year){

    include "database.php";
    
    $query="SELECT * ,SUM(amount) AS totalamount FROM ".$table."   WHERE decision=1 AND YEAR(date_decision)=".$year."  GROUP BY ".$column." ORDER BY totalamount ASC";

    $request = $database->prepare($query);
    $request->execute();
    $data=$request->fetch();
    $count = $request->rowCount();

    if($count==0){

        $result="Aucune donnée disponible";

    }else{

        if($column=="id_customer"){


            $customername=finder($database,$data[$column],"customer","name");

       
            $result=$customername." ( recette : ".$data['totalamount']."€ )";
       
    }else{

            $result=$data[$column]." ( recette : ".$data['totalamount']."€ )";

        }

    }

    return $result;

}


function stat_total($table,$column){

    include "database.php";


    $where="";

    if($table=="formation"){

        $where="WHERE decision=1 ";


    }

    $query="SELECT ".$column." AS total FROM ".$table." ".$where;

    $request = $database->prepare($query);
    $request->execute();

    $total=0;


    while($data=$request->fetch()){

        $total=$total+$data["total"];

    }

    return $total;

}


function isactive($value){

    include "database.php";

    $query="SELECT * FROM user WHERE ip_address='".$value."' AND activity=1";
    
    $request = $database->prepare($query);
    $request->execute();
    $count = $request->rowCount();

 
    return $count;

}

function activated($id){

    include "database.php";

  
    $query="UPDATE user SET activity=1 WHERE id=".$id;
    
    $request = $database->prepare($query);
    $request->execute();


}


function userip($id,$ipadress){

    include "database.php";

  
    $query="UPDATE user SET ip_address='".$ipadress."' WHERE id=".$id;


    
    $request = $database->prepare($query);
    $request->execute();


}



function string_container($string,$container){


    if (preg_match("'/".$container."/'", $string)){

        $result=1;

    }else{

        $result=0;
    }

    return $result;
}



function uploader($file,$directory,$codename){


      /* Getting file name */
   $filename = $codename;

   /* Location */
   $location = "../../public/build/library/".$directory."/".$filename.".pdf";
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);


   /* Valid extensions */
   $valid_extensions = array("doc","pdf");


   $response = "error";
   /* Check file extension */
   if(in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
      if(move_uploaded_file($_FILES['licence']['tmp_name'],$location)){
         $response = $location;
      }
   }

   return $response;




}




function disabled($id){

    include "database.php";

  
    $query="UPDATE user SET activity=0 WHERE id=".$id;
    $query2="UPDATE user SET ip_address='' WHERE id=".$id;
    

    $request = $database->prepare($query);
    $request->execute();

    $request2 = $database->prepare($query2);
    $request2->execute();


}



function selecter($table,$column,$value,$selected){

    include "database.php";
    
    $query="SELECT * FROM ".$table." WHERE ".$column."='".$value."'";
    $request = $database->prepare($query);
    $request->execute();
    $data=$request->fetch();
    return $data[$selected];

}


function selecterAll($table){

    include "database.php";

    $query="SELECT * FROM ".$table;

    
    return $database->prepare($query);


}


function selecterAlldecision($table,$decision){

    include "database.php";

    $query="SELECT * FROM ".$table." WHERE decision=".$decision;

    return $database->prepare($query);

}


/*
    function Select_demands($isfilter,$filter){


        include "database.php";






        if($isfilter==1){

            $query="SELECT * FROM concilan_demand WHERE id_category=$filter";
            $coun="SELECT * FROM concilan_demand WHERE id_category=$filter";

        }else{

            $query="SELECT * FROM concilan_demand";

        }


        $request = $database->prepare($query);
            $request->execute();
            $count = $request->rowCount();

            if($count==0){

                echo "<h1>Il n'y aucune demande pour le moment</h1>";
    
            }else{

                while($data=$request->fetch()){


                    echo "<div class='demand' onclick='read(".$data['id'].")' data-id='".$data['id']."' id='demand".$data['id']."'>";
                    echo "<h1>".$data['subject']."</h1>";
                    echo "<strong>Demande n°".$data['id']."</strong>";
                    echo "<p>".$data['message']."</p>";
                    echo "</div>";
    
            
                }

           

            }

    }
*/

    
    function nb_permissions_month($idpersonal,$date){

        
        include "database.php";

        $query="SELECT * FROM permission WHERE id_personal=$idpersonal AND date_start LIKE '%".$date."%'";
        $request = $database->prepare($query);
        $request->execute();
        $total=0;
        while($data=$request->fetch()){

            $total+=$data["count_permission"];

        };
 
        return $total;

    }

    function nb_diseases_month($idpersonal,$date){

        
        include "database.php";

        $query="SELECT * FROM absence WHERE id_personal=$idpersonal AND date_absence_start LIKE '%".$date."%'";
        $request = $database->prepare($query);
        $request->execute();
        $total=0;
        while($data=$request->fetch()){

            $total+=$data["count_absence"];

        };
 
        return $total;

    }


    function pre_subscribe_concilan($email,$pseudo){

        include "database.php";


        if(check_email($email,'concilan')==0 ){

            $query="INSERT INTO `concilan` (email,name) VALUES ('$email','$pseudo')";
            $request = $database->prepare($query);
            $request->execute();


            $query2="SELECT * From `concilan` ORDER BY id DESC";
      
            $data=fetcher($database,$query2);

            return $data['id'];
            

        }else{

           return 0;

        
        }


    }



    function Send_demand($email,$pseudo,$message,$subject){

        include "database.php";

        $idconcilan=pre_subscribe_concilan($email,$pseudo);




        if($idconcilan!=0){

            $query="INSERT INTO `concilan_demand` (message,id_concilan,subject) VALUES ('$message','$idconcilan','$subject') ";

     

            $request = $database->prepare($query);
                $request->execute();
                       /* include "sendmail.php"; */

                echo  "Votre demande a bien été envoyé";

        }else{


 

            echo  "Cette adresse email a déjà été enregistré";


        }

    }


        
    function Send_advice($message,$id_conciler,$id_category,$id_concilan_demand){

        include "database.php";



            $query="INSERT INTO `conciler_response`(message,id_conciler,id_category,id_concilan_demand) VALUES ('$message','$id_conciler','$id_category','$id_concilan_demand') ";
            $request = $database->prepare($query);
                $request->execute();
                       /* include "sendmail.php"; */

                echo  "Votre demande a bien été envoyé";

            
    }

    
    function Actions($id1,$id2,$feature,$title){

        include "database.php";

            
        if($feature=='certificate' || $feature=='absence' || $feature=="deposit"){


            
            $actions="
      
            
            <td class='actions'>
          
            <img  data-id='".$id2."'   data-frh='".$title."' class='opening pictos' src='/build/media/icons/editer.png'/>
            <img data-id='".$id2."' data-frh='".$title."' class='deleting pictos' src='/build/media/icons/delete.png'/> 
         
            
            </td>
        
            ";
    
    
            }

        if($feature=='quotation' || $feature=='delivery' || $feature=='bill'){


            
        $actions="
  
        
        <td class='actions'>
      
        <img  data-id='".$id2."'   data-frh='".$title."' class='opening pictos' src='/build/media/icons/editer.png'/>
        <img data-id='".$id2."' data-frh='".$title."' class='deleting pictos' src='/build/media/icons/delete.png'/> 
        <img data-id='".$id1."' data-frh='".$title."' class='printing pictos' src='/build/media/icons/print.png'/>
     
        
        </td>
    
        ";


        }



        if($feature=='formation'){

            $decision=finder($database,$id2,$feature,'decision');


            if($decision==3){
            $actions="
      
            
            <td class='actions'>
          
            <img  data-id='".$id1."'   data-frh='".$title."' class='checking pictos' src='/build/media/icons/eye.png'/>
            <img  data-id='".$id2."'   data-frh='".$title."' class='opening pictos' src='/build/media/icons/editer.png'/>
            <img data-id='".$id1."' data-frh='".$title."' class='deleting pictos' src='/build/media/icons/delete.png'/> 
         
            
            </td>
        
            ";

            }



            if($decision==2){



                $actions="
          
                
                <td class='actions'>
              
                <img  data-id='".$id1."'   data-frh='".$title."' class='checking pictos' src='/build/media/icons/eye.png'/>
                <img  data-id='".$id2."'   data-frh='".$title."' class='opening pictos' src='/build/media/icons/editer.png'/>
                <img data-id='".$id1."' data-frh='".$title."' class='deleting pictos' src='/build/media/icons/delete.png'/> 
             
                
                </td>
            
                ";
    
                }

                if($decision==1){

                    $actions="
          


                
                    <td class='actions'>

                  
                    <img data-parent='\' data-directory='".selecter('folder_formation','id_formation',$id1,'folder')."' data-frh='".$title."' class='exploring pictos' src='/build/media/icons/folder.png'/>
                    <img  data-id='".$id1."'   data-frh='".$title."' class='checking pictos' src='/build/media/icons/eye.png'/>
                    <img data-id='".$id1."' data-frh='".$title."' class='printing pictos' src='/build/media/icons/print.png'/>
                    <img data-id='".$id1."' data-frh='".$title."' class='deleting pictos' src='/build/media/icons/delete.png'/>
        
                
        
                    </td>
                
                    ";
    
    
    
                }

                if($decision==0){

                    $actions="
          
                    
                    <td class='actions'>
                  
                    <img data-id='".$id1."' data-frh='".$title."' class='checking pictos' src='/build/media/icons/eye.png'/>
                    <img data-id='".$id1."' data-frh='".$title."' class='asking pictos' src='/build/media/icons/comment.png'/>
                    <img  data-id='".$id2."'   data-frh='".$title."' class='opening pictos' src='/build/media/icons/editer.png'/>
                    <img data-id='".$id1."' data-frh='".$title."' class='deleting pictos' src='/build/media/icons/delete.png'/> 
                    
                    </td>
                
                    ";
    
    
    
                }
    
    
    
            }


        if($feature=='permission'){

            $decision=finder($database,$id2,$feature,'decision');

            if($decision>1){

            
            $actions="
      
            
            <td class='actions'>
          

            <img  data-id='".$id1."'   data-frh='".$title."' class='checking pictos' src='/build/media/icons/eye.png'/>
            <img  data-id='".$id2."'   data-frh='".$title."' class='opening pictos' src='/build/media/icons/editer.png'/>
            <img data-id='".$id2."' data-frh='".$title."' class='deleting pictos' src='/build/media/icons/delete.png'/> 
            

            
            </td>
        
            ";

            }

            if($decision==1){

                $actions="
      
            
                <td class='actions'>
                <img  data-id='".$id1."'   data-frh='".$title."' class='checking pictos' src='/build/media/icons/eye.png'/>
                <img  data-id='".$id2."'   data-frh='".$title."' class='opening pictos' src='/build/media/icons/editer.png'/>
                <img data-id='".$id1."' data-frh='".$title."' class='printing pictos' src='/build/media/icons/print.png'/>

             
                
                </td>
            
                ";



            }

            if($decision==0){

                $actions="
      
            
                <td class='actions'>
                <img data-id='".$id1."' data-frh='".$title."' class='asking pictos' src='/build/media/icons/comment.png'/>
                <img  data-id='".$id1."'   data-frh='".$title."' class='checking pictos' src='/build/media/icons/eye.png'/>
                <img data-id='".$id2."' data-frh='".$title."' class='deleting pictos' src='/build/media/icons/delete.png'/> 
                
                </td>
            
                ";



            }



    
    
            }





        if($feature=='recruit'){


            $cv=finder($database,$id1,$feature,'cv');
            $decision=finder($database,$id1,$feature,'decision');


            if($decision>1){
            
            $actions="
      
            
            <td class='actions'>


            <img  data-id='".$id1."'  data-cv='".$cv."'  data-frh='".$title."' class='viewing pictos' src='/build/media/icons/eye.png'/>
            <img  data-id='".$id1."' data-decision='1'   data-frh='".$title."' class='choosing pictos' src='/build/media/icons/yes.png'/>
            <img data-id='".$id1."' data-decision='0' data-frh='".$title."' class='choosing pictos' src='/build/media/icons/no.png'/> 
            
         
            
            </td>
        
            ";
    
    
            }

            if($decision==1){
            
                $actions="
          
                
                <td class='actions'>
    
                
                <img  data-id='".$id1."'  data-cv='".$cv."'  data-frh='".$title."' class='viewing pictos' src='/build/media/icons/eye.png'/>
   
                
             
                
                </td>
            
                ";
        
        
                }

                if($decision==0){
            
                    $actions="
              
                    
                    <td class='actions'>

                    <img data-id='".$id1."' data-frh='".$title."' class='deleting pictos' src='/build/media/icons/delete.png'/> 
       
                    </td>
                
                    ";

                }
            
            
                    }

        
  

        if (in_array($feature, ['customer', 'partner','personal', 'user','consulting','institute'])) {

                if($feature=="institute"){

                    
                }

        $actions="
        <td class='actions'>
        <img  data-id='".$id1."' data-frh='".$title."' class='opening pictos' src='/build/media/icons/editer.png'/>
        <img data-id='".$id1."' data-frh='".$title."' class='deleting pictos' src='/build/media/icons/delete.png'/> 
        <a href='mailto:".finder($database,$id1,$feature,'email')."'><img data-id='".$id1."' data-frh='".$title."' class='pictos' src='/build/media/icons/message.png'/></a>
        <a href='tel:0".finder($database,$id1,$feature,'telephone')."'><img data-id='".$id1."' data-frh='".$title."' class='pictos' src='/build/media/icons/001-call.png'/></a>
        </td>
        ";

        }

  


        echo $actions;
     
    
    
    
    }

    function InputType($column,$data){

        
        include "database.php";

        $style="";


        if (in_array($column, ['surname'])) {

            $style="style='text-transform:uppercase'";
        }

        if (in_array($column, ['firstname'])) {

            $style="style='text-transform:capitalize'";
        }

       
        $input="<input id='field-".$column."' ".$style." name='".$column."' type='text'  value='".$data."' />";

        if (in_array($column, ['amount', 'price','paid','directory_coef','higher_amount'])) {

            if($data==""){

                $data=0;
            }


            $input="<input id='field-".$column."' name='".$column."' min='0' type='number' step='any' value='".$data."' />";

        }


        if (in_array($column, ['quantity', 'telephone','level','intern','hour','permission','hourly_rate'])) {


            $decimal='';

            if($column=='hour' || $column=='hourly_rate' ){

                $decimal='step="any"';
            }



            $input="<input id='field-".$column."' name='".$column."'  ".$decimal." type='number' value='".$data."' />";

        }


        if ($column=='contact') {


            if ($data!=NULL && preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data) ){

            $arr = explode(' ',trim($data));
            $thefirstname=$arr[0];
            $thesurname=$arr[1];

            }else{

                
            $thefirstname="";
            $thesurname="";

            }

            $input="
            <input id='field-".$column."' name='".$column."' type='hidden' value='".$data."' />
            <input id='field-surname_".$column."' style='width:100px; text-transform:uppercase;' name='surname_".$column."' type='text' placeholder='nom' value='".$thesurname."' />
            <input id='field-firstname_".$column."' style='width:100px; text-transform:capitalize;''  name='firstname_".$column."' type='text' placeholder='prénom' value='".$thefirstname."' />

            
            
            
            
            "
            
            
            
            ;

        }





        if ($column=='address') {

            if($data!=NULL){
            $arr = explode(' ',trim($data));
            if(isset($arr[0])){$number_address=$arr[0];}else{$number_address="";}
            if(isset($arr[1])){$way_address=$arr[1];}else{$way_address="";}
            if(isset($arr[2])){$street_address1=$arr[2];}else{$street_address1="";}
            if(isset($arr[3])){$street_address2=$arr[3];}else{$street_address2="";}
            if(isset($arr[4])){$virgule_address=$arr[4];}else{$virgule_address="";}
            if(isset($arr[5])){$city_address=$arr[5];}else{$city_address="";}
            if(isset($arr[7])){$postal_address=$arr[7];}else{$postal_address="";}
            }else{

                $number_address="";
                $way_address="";
                $street_address1="";
                $street_address2="";
                $virgule_address="";
                $city_address="";
                $postal_address="";

            }
            
            

            $input="
            
            
            <input name='".$column."' type='hidden' value='".$data."' />

            <div class='flexible'>
            <p style='margin:10px;'><label>N°</label><br>
            <input id='field-number_address' name='number_address' style='width:45px; margin-top:10px' type='number' value='".$number_address."'/>
            </p>

            <p style='margin:10px;'><label>Voie</label><br>
            <input id='field-street_address' name='street_address' style=' width:150px; margin-top:10px' type='text' value='".$way_address." ".$street_address1." ".$street_address2."'/>
            </p>

            <p style='margin:10px;'><label>Ville</label><br>
            <input id='field-city_address' name='city_address' style=' width:150px; margin-top:10px' type='text' value='".$city_address."'/>
            </p>

            <p style='margin:10px;'><label>Code postal</label><br>
            <input id='field-postal_address' name='postal_address' style=' width:70px; margin-top:10px' type='number' value='".$postal_address."'/>
            </p>
            </div>
            
            
            ";

        }

        if($column=="id_agency"){


            $selected="";
            $inputoption="";

            for($i=1;$i<=2;$i++){

                if($i==$data){

                    $selected="selected";

                }else{

                    $selected="";
                }

                switch ($i) {case 1:
                        $selectedname="Paris";
                        break;
                            case 2:
                        $selectedname="Toulouse";
                        break;
                            }
                $inputoption.=" <option value='".$i."' ".$selected.">".$selectedname."</option>";
            }

            $input="<select id='field-".$column."' name='".$column."'>".$inputoption."</select>";

        }


        if($column=="id_director_agency_1" || $column=="id_director_agency_2" ){
            

            $input="<select id='field-".$column."' name='".$column."'>".Lister_selected($database,'user',$data)."</select>";

        }


        if($column=="id_quotation"){
            
            $input="<select id='field-".$column."' name='".$column."'>".Lister_selected($database,'quotation',$data)."</select>";

        }

      

      

        if ($column=='password') {

            $input="<input  id='field-".$column."' name='".$column."' value='".$data."' type='password' />";
        }


        if($column=="level"){


            $selected="";
            $inputoption="";

            for($i=1;$i<=4;$i++){

                
                if($i==$data){

                    $selected="selected";

                }else{

                    $selected="";
                }

                switch ($i) {
                    
                            case 1:
                        $selectedname="Administrateur";
                        break;

                        case 2:
                            $selectedname="Manager";
                            break;

                        case 3:
                            $selectedname="Gestionnaire";
                            break;

                            case 4:
                                $selectedname="Consultant";
                                break;
                            

                            case 5:
                                $selectedname="Testeur";
                                break;
                            }


                $inputoption.=" <option value='".$i."' ".$selected.">".$selectedname."</option>";
            }

            $input="<select id='field-".$column."' name='".$column."'>".$inputoption."</select>";

        }


        if ($column=='cv') {

            $input="<input id='field-".$column."' name='".$column."' id='id_".$column."'  type='file' value='' />";
      
        }





        if (preg_match('/date/', $column))  {

            if($column=="date_start"){

                $hourdata="data-hour='2'";

            }else{

                $hourdata="";
                
            }


            $input="<input id='field-".$column."' name='".$column."'  ".$hourdata." type='date' value='".$data."' />";



        }

        if ( /* || $column=='state_consulting' */ $column=='intern') {

            $yes="";
            $no="";

            $question="";
            
            if($column=='state_consulting'){

                $yes=" class='lightning' data-light='1' ";
                $no=" class='lightning' data-light='0' ";
                $question="Est-il(elle) disponible pour travailler ?:";
            }
            

            if($column=='intern'){

                $yes=" class='lightning' data-light='1' ";
                $no=" class='lightning' data-light='0' ";
                $question="Est-il(elle) salarié de l'entreprise ?:";

            }
            
           

               
            $input='<fieldset>

            <legend>'.$question.'</legend>

            <div>
              <input '.$yes.' type="radio" id="yesyes" name="'.$column.'" value="1"
                     checked>
              <label for="yesyes">Oui</label>
            </div>
        
            <div>
              <input '.$no.' type="radio" id="nono" name="'.$column.'" value="0">
              <label for="nono">Non</label>
            </div>
        
          
        </fieldset>';

    

        }


        if ($column=='absence_type') {

            $selected1="";
            $selected2="";
            $selected3="";

            if($data==1){$selected1="selected";}
            if($data==2){$selected2="selected";}
            if($data==0){$selected3="selected";}

            $input="<select id='field-".$column."' name='absence_type'>

            <option value='1'  ".$selected1.">Maladie</option>
            <option value='2' ".$selected2.">Autres</option>
            <option value='0' ".$selected3.">Injustifié</option>
            </select>
            ";

        }

        if ($column=='reason') {

            $selected1="";
            $selected2="";
            $selected3="";
            $selected4="";
            $selected5="";

            if($data=="permission"){$selected1="selected";}
            if($data=="family"){$selected2="selected";}
            if($data=="nopaid"){$selected3="selected";}
            if($data=="anticipated"){$selected4="selected";}
            if($data=="other"){$selected5="selected";}
            
            $input="<select id='field-".$column."' name='reason'>

            <option value='permission' ".$selected1.">Congés payés</option>
            <option value='family' ".$selected2.">Congés pour évènement familial</option>
            <option value='nopaid' ".$selected3.">Congés sans solde</option>
            <option value='anticipated' ".$selected4.">Congés par anticipation</option>
            <option value='other' ".$selected5.">Autre motifs</option>
                    
            </select>
            ";

        }


        
        if (in_array($column, ['id_customer','id_delivery'])) {


                $feature=substr($column,3);

            $input="<select id='field-".$column."' name='".$column."' >".Lister_selected($database,$feature,$data)."</select>";

        }



        if ($column=='date_candidacy') {


            $input="<input id='field-".$column."' name='".$column."' type='date' value='".date('m-d-Y')."' />";


        }


        if ($column=='formation_already' || $column=='commentary') {


            $input="<br><textarea id='field-".$column."' name='".$column."'>".$data."</textarea>";


        }



        if (in_array($column, ['fr_role','fr_title'])) {

            $input="<input id='field-".$column."' name='".$column."' type='hidden' value='".$data."'/>";
        }



        return $input;





    }
    

    function Table($feature,$title){

        
        include 'database.php';
        include "searchbar.php";
        
        $query="SHOW COLUMNS FROM ".$feature." WHERE Extra NOT LIKE '%auto_increment%'";

        $order=" ORDER BY id DESC";
        $group="";
        $thename="";
        $where="";

        $userlevel=selecter("user","id",the_iduser(),"level");
        $idpersonal=selecter("personal","id_user",the_iduser(),"id");
        $idagencyuser=selecter("user","id",the_iduser(),"id_agency");

        if($feature=="permission" && $userlevel>3 ){

            $where=" WHERE id_personal=".$idpersonal;

        }

        if($feature=="user" && $userlevel>3 ){

            $where=" WHERE id=".the_iduser();

        }

        if($feature=="permission" && $userlevel==3 ){


            $where=" INNER JOIN personal ON personal.id = permission.id_personal WHERE personal.id_agency=".$idagencyuser;

        }


        $row="*";

        if($feature=="formation"){

            $row="*,SUM(amount) AS totalamount, SUM(wage) AS totalwage, SUM(cost) AS totalcost";

        }

        if($feature=="formation" || $feature=="permission"){

            $group=" GROUP BY id_".$feature;
            $order=" ORDER BY ".$feature.".id DESC";
            $thename="id_".$feature;

        }

        
        if($feature=="partner" || $feature=="customer" || $feature=="partner" || $feature=="institute" || $feature=="certificate" ){

            $group="";
            $order=" ORDER BY ".$feature.".id DESC";
            $thename="name";

        }


        if($feature=="personal" || $feature=="user" || $feature=="consulting" ){

            $group="";
            $order=" ORDER BY ".$feature.".id DESC";
            $thename="firstname";

        }
        


        if(isset($_POST['searchname'])){

     
            if($thename=="firstname"){

                $where=" WHERE firstname like '%".$_POST['searchname']."%' OR surname like '%".$_POST['searchname']."%'";

            }else{

                if($thename!=""){
                    $where=" WHERE ".$thename." like '%".$_POST['searchname']."%'";

                }
              

            }
            
        }


        if(isset($_POST['filter']) && isset($_POST['order'])  ){

            $order=" ORDER BY ".$_POST['filter']." ".$_POST['order'];
        }
    
    
        $query2="SELECT ".$row." FROM ".$feature.$where.$group.$order;
  


        $column = $database->prepare($query);
        $row = $database->prepare($query2);
        $column->execute();
        $row->execute();

            echo " <div id='notification'></div>";
            echo "<div id='thetable'>";
        echo "<table>
        <thead>
            <tr>
                <th>".$title."</th>
            </tr>";

          echo "<tr id='columns'>";

          $count=0;

          $maximum=5;

          if($feature=="delivery"){

            $maximum=3;

          }

          if($feature=="certificate"){

            $maximum=4;

          }


          if($feature=="absence"){

            $maximum=5;

          }
          
          if($feature=="formation"){

            $maximum=9;
          }

          if($feature=="absence"){

            $maximum=4;
          }

          $z=1;
          
          $neworder="ASC";
          $arrowposition="down";
    
          while ($columndata = $column->fetch()){


            $columnname=$columndata['Field'];


            include 'fr_columndata.php';
            
            if($count<$maximum){

                if(isset($_POST['filter']) && isset($_POST['order'])  ){

                    $colnb=$_POST['colnumber'];

                    if($colnb==$z){

                        if($_POST['order']=="ASC"){
                    $neworder="DESC";
                    $arrowposition="up";
                        }else{


                            $neworder="ASC";
                            $arrowposition="down";


                        }

                    }else{

                        $neworder="ASC";
                        $arrowposition="down";

                    }

                }


                echo "<td id='col-".$columndata['Field']."' class='filtering'  data-filter='".$columndata['Field']."'   data-feature='".$feature."'  data-order='".$neworder."' data-colnumber='".$z."' >".$columnname."<span id='arrow".$z."' class='arrow ".$arrowposition."'></span></td>";
                
                $z++;
            }

            $count=$count+1;


          }

          if($count>$maximum){

            $count=$maximum;
          }
         
       
          echo "<td id='action' >Actions</td>";

            echo "</tr>";
    
    echo"</thead><tbody>";

    $nb=0;
          
            
        while ($datarow =  $row->fetch()){

            $nb++;
            
          $min=0;
            $pager=4;
            ;
            

                if(isset($_POST['range'])){

                    $min=$_POST['currentmin'];

                    if($min>=$_POST['totalrow']){

                        $min=$_POST['totalrow'];
                    }
                    

                    if($min<1){

                        $min=0;
                    }

                   
                }


                $max=$min+$pager;

            
            if($min<$nb && $nb<=$max){

                $hidden_ones="";

            }else{

                $hidden_ones="hidden";
            }

            $naming="";
            
            if(isset($datarow['name'])){$naming=$datarow['name'];}
            if(isset($datarow['id_formation'])){$naming=$datarow['id_formation'];}
            if(isset($datarow['id_permission'])){$naming=$datarow['id_permission'];}
            if(isset($datarow['firstname'])){$naming=$datarow['surname']." ".$datarow['firstname'];}
    

                echo " <tr id='value".$nb."'  data-name='".$naming."' class='values ".$hidden_ones."' data-id='".$datarow['id']."' >";
    
                for($i=1; $i<$count+1;$i++){


              
                        if( isset($datarow['decision']) && $i==5 && $feature!="formation" || isset($datarow['decision']) && $i==9 && $feature=="formation" || isset($datarow['licence']) && $i==5 || /* isset($datarow['state_consulting']) && $i==5  || */ isset($datarow['level']) && $i==5  ){
                            
                        if(isset($datarow['decision'])){
                        if($datarow['decision']==0){


                            $validator="";


                            if($feature=="formation"){

                                    $theid=$datarow['id_user'];

                                    $validator=" par <br>".finder($database,$theid,"user","firstname");

                            }

                            if($feature=="permission"){

                                $theid=$datarow['id'];

                                $validator="par <br>".finder($database,$theid,$feature,"validator");

                            }

                            echo "<td class='value' > <strong style='color:red'>Rejetée ".$validator."</strong></td>";
                        }




                    
                        if($datarow['decision']==1){


                            $validator="";


                            if($feature=="formation"){

                                    $theid=$datarow['id_user'];
                                    


                                    $validator=" par <br>".finder($database,$theid,"user","firstname");

                            }


                            if($feature=="permission"){


                                $theid=$datarow['id'];

                                $validator="par <br>".finder($database,$theid,$feature,"validator");

                            }


                            echo "<td class='value' > <strong style='color:green'>Validée ".$validator."</strong></td>";
                            
                        }

                        
                        if($datarow['decision']==2){

                            echo "<td class='value' ><strong style='color:orange'> En attente de validation finale</strong></td>";
                        }

                        if($datarow['decision']==3){

                            echo "<td class='value'> <strong style='color:blue'>En attente de 1er validation</strong></td>";
                        }
                    }

                    if(isset($datarow['licence'])){

                        if($datarow['licence']==0){

                                
                                    $codename=$datarow["id_".$feature];
                                

                            $uploadbutton='<br><form class="uploader" method="post" data-action="upload"  enctype="multipart/form-data">


                            <input type="hidden" name="id" value="'.$datarow["id"].'"/>
                            <input type="hidden" name="table" value="'.$feature.'"/>
                            <input type="hidden" name="directory" value="licence"/>
                                <input type="hidden" name="codename" value="'.$codename.'"/>
                                <input type="file" name="myfile" class="drop-zone__input">
                              <input type="submit" value="Déposer"/>
                            </form>';

                            echo "<td class='value' > <strong style='color:red'>
                            
                            
                            
                            Introuvable".$uploadbutton."
                            
                            
                            
                            
                            </strong></td>";
                        }

                    

                        if($datarow['licence']==1){


                           $view="<a href='./build/library/licence/".$datarow["id_".$feature].".pdf' target='_blank'><img class='pictos white' src='/build/media/icons/eye.png'/></a>";

                            echo "<td class='value' > <strong style='color:green'>".$view."Déposé</strong></td>";
                        }


                    }

                    if(isset($datarow['level'])){



                        if($datarow['level']==0){

                            echo "<td class='value' > <strong style='color: aqua;'>".selecter("level","id",$datarow['level'],"level_fr")."</strong></td>";
                        }

                        

                        if($datarow['level']==1){

                            echo "<td class='value' style='color:red'> <strong>".selecter("level","id",$datarow['level'],"level_fr")."</strong></td>";
                        }

                        if($datarow['level']==2){

                            echo "<td class='value' style='color:orange'> <strong>".selecter("level","id",$datarow['level'],"level_fr")."</strong></td>";
                        }

                        if($datarow['level']==3){

                            echo "<td class='value' style='color:yellow' > <strong>".selecter("level","id",$datarow['level'],"level_fr")."</strong></td>";
                        }

                        if($datarow['level']==4){

                            echo "<td class='value' style='color: greenyellow;'> <strong>".selecter("level","id",$datarow['level'],"level_fr")."</strong></td>";
                        }


                        
                        if($datarow['level']==5){

                            echo "<td class='value' style='color:green'> <strong>".selecter("level","id",$datarow['level'],"level_fr")."</strong></td>";
                        }



                    }

                 if(isset($datarow['state_consulting'])){

                 if($datarow['state_consulting']==0){

                            echo "<td class='value' > <strong style='color:red'>Indisponible</strong></td>";
                        }

                    

                        if($datarow['state_consulting']==1){

                            echo "<td class='value' > <strong style='color:green'>Disponible</strong></td>";
                        } 


                    }

                    }else{


                        if(isset($datarow['activity']) && $i==4){


                            if($datarow['activity']==0){

                                echo "<td class='value' style='color:red'>Déconnecté(e)</td>";


                            }else{


                                echo "<td class='value' style='color:green'>Connecté(e)</td>";

                            }


                        }else{
                            

                            if(validateDate($datarow[$i])==TRUE){


                                echo "<td class='value' >".date('d/m/Y', strtotime($datarow[$i]))."</td>";

                            }else{

                                if(isset($datarow['absence_type']) && $i==2){

                                    if($datarow['absence_type']==0){
            
                                        echo "<td class='value' > <strong style='color:red'>Non justifié</strong></td>";
            
                                    }
            
                                    if($datarow['absence_type']==1){
            
                                        echo "<td class='value' > <strong style='color:green'>Maladie</strong></td>";
            
                                    }
            
                                    if($datarow['absence_type']==2){
            
                                        echo "<td class='value' > <strong style='color:orange'>Autre</strong></td>";
            
                                    }
            
                                    
                                }else{


                                    
                                    if($feature=="formation" && $i==2){

                                        echo "<td class='value'>".selecter("customer","id",$datarow[2],"name")."</td>";
                                        
                                    }else{

                                        if($feature=="absence" && $i==4){

                                            echo "<td class='value'>".date("d/m/Y",strtotime($datarow[4]))."</td>";
                                            
                                        }else{


                                            

                            /*----------------------IGGDRASIL-----------------------*/


                                if($i==3 && $feature=='personal' || $i==4 && $feature=='partner' || $i==3 && $feature=='customer'){

                                    $zero=0;

                                }else{

                                    $zero="";
                                }

                                $metric="";
                                $thevalue=$datarow[$i];


                                if($i==6 && $feature=='formation'){

                                    $thevalue=$datarow["cost"];
                                }

                                if($i==5 && $feature=='consulting'){

                                    $thevalue=selecter("customer","id",$datarow["id_customer"],"name");
                                }



                                if($i==6 && $feature=='formation'){

                                    $thevalue=$datarow["totalcost"];
                                }



                                if($i==7 && $feature=='formation'){

                                    $thevalue=$datarow["totalwage"];
                                }


                                if($i==8 && $feature=='formation'){

                                    $thevalue=$datarow["totalamount"];
                                }

                                if($i==1 && $feature=='absence'){

                                    $thevalue=$datarow["personal_name"];
                                }

                                if($i==2 && $feature=="quotation"){


                                    $thevalue=finder($database,$datarow['id_customer'],"customer","name"); 
            
            
            
                                }

                                
                                if($i==4 && $feature=="quotation"){


                                    $thevalue=finder($database,$datarow['id_delivery'],"delivery","name"); 
            
            
            
                                }
            
            

                                if($i==1 && ( $feature=='consulting' || $feature=='user')){

                                    $thevalue=strtoupper($datarow["surname"]);
                                }

                                if($i==2 && ( $feature=='consulting' || $feature=='user')){

                                    $thevalue=ucfirst($datarow["firstname"]);
                                }


        
                                

                                echo "<td class='value' >".$zero.$thevalue.$metric."</td>";

                                /*----------------------IGGDRASIL-----------------------*/
                            }
                            }

                        }


                            }

                        
                        }

                      

                    }


                }
                  
                if (str_contains($datarow[1], 'FRM') || str_contains($datarow[1], 'CON')  || str_contains($datarow[1], 'DEV')) //*ID FORMATION OR PERMISSION
                {
                    $idaction1=$datarow[1];
                    $idaction2=$datarow[0];
                    
                }else{

                    $idaction1=$datarow[0];
                    $idaction2=$datarow[0];

                }



                Actions($idaction1,$idaction2,$feature,$datarow[$lang.'_title']);
            
            
               echo "</tr>";
            
            
            
    
    
    
    
    
        }

        $total=$nb;

        $totalcalcul=$total/4;

        $totalpage=round($totalcalcul);

        if($totalcalcul>$totalpage){

            $totalpage=$totalpage+1;
        }

        if(isset($_POST['newpage'])){

            $currentpage=$_POST['newpage'];
            $currentmin=$_POST['currentmin'];

            if($currentmin>=$_POST['totalrow']){

                $currentmin=$_POST['totalrow'];
            }


        }else{

            $currentpage=1;
            $currentmin=0;
        }



        if($total<=4){

            $hiddenclass="hidden";

        }else{


            $hiddenclass="";


        }


        echo "</tbody></table></div><div id='pagescroll'><span style='float:left;'>Résultat total: ".$total." lignes</span><button class='actionbutton refreshing'>Rafraichir le tableau</button><button id='previouspage' data-range='-4'  data-feature='".$feature."'   data-total='".$total."' class='actionbutton ".$hiddenclass."'>Page précédente</button><button id='nextpage' data-range='4'  data-feature='".$feature."' data-total='".$total."' class='actionbutton ".$hiddenclass."'>Page suivante</button>Page n°<span id='pagenumeration' data-minimum='".$currentmin."' data-pagenum='".$currentpage."' data-totalpage='".$totalpage."'>".$currentpage."</span>/".$totalpage."</div> ";
      

    }

    function DeleteValue($feature,$id){

        include 'database.php';

        if($feature=="formation"){

            $query="DELETE FROM ".$feature." WHERE id_formation = '".$id."'";

        }else{

            $query="DELETE FROM ".$feature." WHERE id = ".$id;

        }



        executer($database,$query);


    }


    function DeleteValues($feature,$where,$value){

        include 'database.php';

            $query="DELETE FROM ".$feature." WHERE ".$where." = '".$value."'";

        executer($database,$query);

    }



    function EditValue($feature,$value,$result,$quantity,$id){

        include 'database.php';

        if($value=='price'){

            $query2="UPDATE ".$feature." SET amount=".$result*$quantity." WHERE id=".$id;

            executer($database,$query2);

        }else{

                if($feature=="formation" || $feature=="permission"){

                    $query="UPDATE ".$feature." SET ".$value."=".$result." WHERE id_".$feature."='".$id."'";

                }else{

                    $query="UPDATE ".$feature." SET ".$value."=".$result." WHERE id=".$id;
                    
    
                }


            executer($database,$query);


        }

      



    }


    function EditTableform($title,$id,$feature,$featuremessage){


        include 'database.php';
        
        
        $query="SHOW COLUMNS FROM ".$feature." WHERE Extra NOT LIKE '%auto_increment%'";
        $query2="SELECT * FROM ".$feature." WHERE id=".$id;

        $column = $database->prepare($query);
        $row = $database->prepare($query2);

        $column->execute();
        $row->execute();




        echo "<div id='editform'>";

        echo "<p><input type='hidden' name='featureid' value='".$id."'></p>";
        echo "<p><input type='hidden' name='featurename' value='".$feature."'></p>";
        echo "<p><input type='hidden' name='featuremessage' value='".$featuremessage."'></p>";

        $count=1;

        $datarow =  $row->fetch();

        while ($columndata = $column->fetch()){

            if(in_array($columndata['Field'], ['id_superior','id_purchase_order','id_certificate','id_consulting','id_institute','licence','state_consulting','actual_month','seniority','fr_title','fr_role','untouchable','activity', 'fr_job','cv','excuses','decision','id_personal','id_user','ip_address'])){

                $class="class='hidden'";

            }else{

                $class="";

            }


            $columnname=$columndata['Field'];

            include "fr_columndata.php";

            echo "<p id='edit-".$columndata['Field']."' ".$class."><label>".$columnname."</label>".InputType($columndata['Field'],$datarow[$count])."</p>";

            $count=$count+1;

        }

        echo "</div>";
   


    }


    
    function AddTableform($feature,$featuremessage){


        include 'database.php';

      
        
        $query="SHOW COLUMNS FROM ".$feature." WHERE Extra NOT LIKE '%auto_increment%'";

        $column = $database->prepare($query);
        $column->execute();

        echo "<div id='addform'>";

        echo "<p><input type='hidden' name='featurename' value='".$feature."'></p>";
        echo "<p><input type='hidden' name='featuremessage' value='".$featuremessage."'></p>";

        $count=1;
        $page=1;
        

        echo "<div id='page-".$page."' class='formpart'>";

            /*-------------------------------------EXCEPTIONS-----------------------------------------------------*/

            if($feature=="formation"){

                $relation=0;

              

                /*echo "<p id='id_costumer'><label>Entreprise</label><select id='field-id_costumer' name='id_customer'>".Data_Lister($database,"customer")."</select></p>"; */

                echo "<p id='id_institute'><label>Organisme de formation</label><select id='field-id_institute' name='id_institute'>".Lister($database,"institute")."</select><br><span class='notice'>Si vous ne trouvez pas votre organisme de formation, veuillez l'ajouter</span> </p>";
                echo "<p id='id_certificate'><label>Intitulé de formation <span id='institutename'></span></label><select id='field-id_certificate' name='id_certificate'>".Lister($database,"certificate")."</select></p>";
                echo "<p id='id_costumer'><label>Entreprise</label><input type='text' list='customerlist' id='field-id_costumer' name='id_customer'><datalist id='customerlist'>".Data_Lister($database,"customer")."</datalist></select><span class='actionbutton' id='companylist'>Afficher la liste des intérimaires</span> </p>"; 
                echo "<p id='id_consulting'><label>Les intérimaire(s) de l'entreprise <span id='company'></span></label><div id='consulting-listing'>".Multi_Lister("Liste des intérimaires",$database,"consulting",$relation)."</div></p>";
                echo "<input id='field-id_consulting' type='hidden' name='id_consulting' value='0' />";

            }

            if($feature=="certificate"){

                echo "<p id='id_institute'><label>Organisme de formation</label><select id='field-id_institute' name='id_institute'>".Lister($database,"institute")."</select></p>";

            }

            $userlevel=selecter("user","id",the_iduser(),"level");

            /*
            if($feature=="permission" && $userlevel<=0 ){

                echo "<p><label>Choisir le nom du salarié :</label><select id='field-personallist' name='personalist'>".Lister($database,"personal")."</select></p>";

            }*/




        /*---------------------------------EXCEPTIONS-----------------------------------------------------*/
                
        while ($columndata = $column->fetch()){

            $state="";

            if($columndata['Field']=="customer_telephone" || $columndata['Field']=="customer_tva" || $columndata['Field']=="price" && $feature=="quotation"  || $columndata['Field']=="amount" && ( $feature=="quotation" || $feature=="deposit"  )  ||  $columndata['Field']=="hour_appi" || $columndata['Field']=="count_absence" || $columndata['Field']=="permission_anticipated" || $columndata['Field']=="date_absence" || $columndata['Field']=="left_permission" || str_contains($columndata['Field'], 'count_permission') || $columndata['Field']=="anticipated" || $columndata['Field']=="date_birth" || $columndata['Field']=="date_contrat_end" || $columndata['Field']=="date_contrat_start" || $columndata['Field']=="validator" || $columndata['Field']=="sender" || $columndata['Field']=="date_decision" || $columndata['Field']=="state_consulting" || $columndata['Field']=="seniority" || $columndata['Field']=="seniority" || $columndata['Field']=="actual_month" || $columndata['Field']=="ip_address" || $columndata['Field']=="activity" || $columndata['Field']=="excuses" ||  $columndata['Field']=="licence" || $columndata['Field']=="cv" ||  $columndata['Field']=="institute_address" && $feature=="formation"  || $columndata['Field']=="wage" &&  $feature=="formation"   || $columndata['Field']=="cost"  &&  $feature=="formation"   || $columndata['Field']=="hourly_rate" && $feature=="formation"   ||  $columndata['Field']=="hour" && $feature=="formation"  || $columndata['Field']=="formation_type"  && $feature=="formation"   ||  $columndata['Field']=="amount"  &&  $feature=="formation" || $columndata['Field']=="untouchable" || $columndata['Field']==$lang."_title"  ||  $columndata['Field']==$lang."_role" || $columndata['Field']==$lang."_job"  ||  $columndata['Field']=="date_candidacy" || str_contains($columndata['Field'], '_name')){

                $hidden='hidden';

                if($columndata['Field']=="state_consulting"){

                    $state=1;

                }

                if($columndata['Field']=="sender"){

                    $state=the_username();

                }


                $isinput='<input type="hidden" id="field-'.$columndata['Field'].'" name="'.$columndata['Field'].'" value="'.$state.'" /> ';
                $idname='';
              /*  $isinput='<input type="hidden" name="'.$columndata['Field'].'" value=""/> '; */
                
                

            }
            
            else{

                $hidden='';
                $idname=$columndata['Field'];
                $isinput=InputType($columndata['Field'],NULL);
              
            }

            if($columndata['Field']=="decision" ){

                $hidden='hidden';
                $idname=$columndata['Field'];

                if($feature=="permission"){

                    $decisiondefault=2;
                }else{

                    $decisiondefault=3;

                }


                $isinput="<input type='hidden' id='field-".$columndata['Field']."' name='".$columndata['Field']."' value='".$decisiondefault."' /> ";


            }

           
            if(str_contains($columndata['Field'], 'nb_')){


                $hidden="hidden";
                $idname='';
                $isinput="";

            }

         
            if(str_contains($columndata['Field'], 'id_') && !str_contains($columndata['Field'], $feature) && ($feature!="consulting" || $feature!="deposit") && $columndata['Field']!="id_agency" && $columndata['Field']!="id_quotation"){

                $hidden='hidden';
                $isinput='';
                    $idname='';
              

            
                if($columndata['Field']=="id_purchase_order"){

                    $idname=$columndata['Field'];
                    $isinput="<input type='hidden' id='field-".$columndata['Field']."'  name='".$columndata['Field']."' value='' /> ";

                }




                if($columndata['Field']=="id_user"){

                    $iduser=the_iduser();
                    $idname=$columndata['Field'];
                    $isinput="<input type='hidden' id='field-".$columndata['Field']."' name='".$columndata['Field']."' value='".$iduser."' /> ";


                }


        if($columndata['Field']=="id_customer"){

           

                    $hidden="";
                    $idname=$columndata['Field'];
                    $isinput="<select id='field-".$columndata['Field']."' name='".$columndata['Field']."'>".

                    Lister($database,"customer")

                    ."</select><span class='actionbutton routing' data-id='customer' >Ajouter un client</span>";

                } 

                if($columndata['Field']=="id_delivery"){

                    $hidden="";
                    $idname=$columndata['Field'];
                    $isinput="<select id='field-".$columndata['Field']."' name='".$columndata['Field']."'>".

                    Lister($database,"delivery")

                    ."</select><span class='actionbutton routing' data-id='delivery' >Ajouter une prestation </span>";

                } 


                if($columndata['Field']=='id_personal'){

            
                    $iduser=the_iduser();
        
                    $theresult=finder_personal_id($database,$iduser,"personal","id");

                    $idname=$columndata['Field'];
        
                    if($feature!="absence"){

                        $isinput="<input type='hidden' id='field-".$columndata['Field']."' name='".$columndata['Field']."' value='".$theresult."' />";
        

                    }else{


                        $isinput="<select id='field-".$columndata['Field']."' name='".$columndata['Field']."'>
                        
                        
                        ".Lister($database,"personal")."
                        
                        
                        </select>";
        

                    }
                    
                }




            }

            if($columndata['Field']=="id_".$feature){

                $code=generateidCode($feature);

                $idname=$columndata['Field'];
                $hidden='hidden';
                $isinput='<input type="hidden"  id="field-'.$columndata['Field'].'"  name="id_'.$feature.'" value="'.$code.' "  />';
            }



            if($columndata['Field']=="date_send"){
                $idname=$columndata['Field'];
                $hidden='hidden';
                $isinput='<input type="hidden" id="field-'.$columndata['Field'].'"  name="date_send" value="'.date('Y-m-d').' "  />';
            }


            $columnname=$columndata['Field'];


            include 'fr_columndata.php';


            if($feature=="absence" && $columndata['Field']!="personal_name" && $columndata['Field']!="date_absence"){
                $hidden="";
            }

            if($feature=="absence" && $columndata['Field']=="count_absence"){

                $hidden="hidden";
            }


            if(($columndata['Field']=="date_contrat_start" || $columndata['Field']=="date_contrat_end" || $columndata['Field']=="date_birth") && $feature=="consulting"){

                $hidden="";

                $hourdata="";

    

                $isinput='<input type="date" id="field-'.$columndata['Field'].'"  '.$hourdata.' name="'.$columndata['Field'].'" value="" />';
            }

            echo "<p id='".$idname."' class='".$hidden."'><label>".$columnname."</label>".$isinput."</p>";

            $count=$count+1;

            $division=6;

            if($feature=="formation" || $feature=="quotation"){$division=24;}  if($feature=="personal"){$division=5;} if($feature=="consulting"){$division=9;}  if($feature=="permission"){$division=16;} if($feature=="customer"){$division=16;}  if($feature=="institute"){$division=16;} 
            if($feature=="user"){$division=10;} 

            
            if($count%$division==0){


                $page++;

                echo "</div><div id='page-".$page."' class='formpart hidden'>";
    
    
            }


                  


        }

        /*-------------------------------------EXCEPTIONS-----------------------------------------------------*/

        if($feature=="user"){


            echo "<p id='permission'><label>Solde de congés :</label><input id='field-permission' type='number' name='permission' value='0' /></p>";

        }

         /*-------------------------------------EXCEPTIONS-----------------------------------------------------*/

         $invisible="";

        if($feature=="formation" || $feature=="quotation" || $feature=="certificate" || $feature=="absence" || $feature=="permission" || $feature=="institute" || $feature=="customer"){

            $invisible="class='hidden'";
        }

        
        echo "</div>";

        echo '<script>
        function resetForm() {
            document.getElementById("sender").reset();
        }
        </script>';

        $pagecounter=1;

        if($feature=="institute" || $feature=="customer" || $feature=="consulting" || $feature=="user" ){ $pagecounter=2; }


        echo "<br><br><strong ".$invisible." style='margin-top:80px; font-size:20px;' >Page <span data-currentpage='1' data-maxpage='".$pagecounter."' da id='numberpage'>1</span>/".$pagecounter."</strong>";

        
        echo "<div id='buttons'><a href='' style='text-decoration:none;'><span class='cancel' >Annuler</span></a> <span id='currentpage'  data-page='1' ></span> <span ".$invisible." onclick='page(".$page.",0)'>Précédent</span>  <span ".$invisible." onclick='page(".$page.",1)'>Suivant</span> ";
              
   
    }





    function EditValueform($title,$id,$feature,$valuename,$quantity,$featuremessage){


        
        echo "   
        <form id='sender' data-action='edit' method='POST' action='' >
        <div id='notification'></div>
        <span>".$title."</span><br>
        <input type='hidden' name='featureid' value='".$id."' />
        <input type='hidden' name='featurename' value='".$feature."' />
        <input type='hidden' name='featuremessage' value='".$featuremessage."' />
        <input type='hidden' name='valuename' value='".$valuename."' />
        <input type='hidden' name='quantity' value='".$quantity."' />
        <input type='number' name='setvalue' value='0' />
        <input type='submit' value='Modifier' />
        </form>";


    }
    



    function Viewer(){

        include 'database.php';


        





    }

        


    function Makedir($child,$id){

        include "database.php";

        $source="../../public/build/library/stockage";

        $directory=$source."/".$child;

        mkdir($directory);
        mkdir($directory."/Convention");
        mkdir($directory."/Programme");
        mkdir($directory."/Fiche d'émargement");
        mkdir($directory."/Certificat réussi");
        mkdir($directory."/Facture");
        mkdir($directory."/Convocation");

        addValue($database,$child."','".$id,"folder_formation","folder,id_formation");
        




    }


    function Profile($feature,$title,$id){

        include 'database.php';


        echo '    
        <a id="backtofeature" class="hidden" href=""><div class="navigate"> <img class="pictos" src="build/media/icons/return.png"/>Retour à la page principale<span class="featurespan"></span></div></a>
        ';

        echo "<div id='notification'></div>";

        echo '<style>
        

        #edit-date_decision, #edit-amount, #edit-id_formation, #edit-wage, #edit-nb_consulting , #edit-comment, #edit-date_start_2, #edit-date_end_2, #edit-date_start_3, #edit-date_end_3, #edit-count_permission_2, #edit-count_permission_3 {
        
            display:none;
        }

        #editform{

            height:350px!important;

        }


        

        #edit-date_send{
        
        display:none;
        
        }
        
        </style>';
        
        $query="SHOW COLUMNS FROM ".$feature." WHERE Extra NOT LIKE '%auto_increment%'";

        $query2="SELECT * FROM ".$feature." WHERE id=".$id;

        $column = $database->prepare($query);
        $row = $database->prepare($query2);


        $column->execute();
        $row->execute();

        echo "<h1>".$title."</h1>";

          $count=0;

          echo "<div class='central'><strong>Les informations du ".$title."</strong></div>";

          echo "<div class='flexible'>";

            echo "<div id='informations'>";


            if($feature=="formation"){

                $nbinterns=selecter("formation","id",$id,"nb_consulting");
                $idformation=selecter("formation","id",$id,"id_formation");

                if($nbinterns>1){

                    echo "<strong>Choisir un intérimaire :</strong><div id='buttons' style='text-align:center; text-align: center;overflow-y: scroll;background-color:#00000036; height: 111px; margin-top: 0px;'><br><br>". Lister_interns($database,$idformation)."</div>";


                }
                

            }




            echo "<div class='flexible'>";
            
          echo  "<ul id='columnlist'>";

          while ($columndata = $column->fetch()){

            if (in_array($columndata['Field'], ['date_end_3','date_end_2','date_start_3','date_start_2','id_institute','permission_anticipated','state_consulting','actual_month','seniority', 'id_user','fr_role','fr_title','excuses','decision','id_personal','permission','untouchable','cv','fr_job','ip_address','password'])) {

                $hidden="class='hidden'";

            }else{

                $hidden="";
            }


            if(in_array($columndata['Field'], ['id_consulting','id_certificate','id_purchase_order','id_institute','nb_consulting']) && $feature=="formation"){

                $hidden="class='hidden'";
            }

            

            $columnname=$columndata['Field'];


            include 'fr_columndata.php';

       

           echo "<li ".$hidden."><strong>".$columnname." : </strong></li>";

           $count=$count+1;

          }
    
            echo "</ul>";
           
    echo"<ul id='rowlist'>";


        while ($datarow = $row->fetch()){


                for($i=1; $i<$count+1;$i++){

                    $hidden="";
                    $dataresult=$datarow[$i];


// || isset($datarow['id_user'])  ||  isset($datarow['fr_role'])  ||  isset($datarow['fr_title']) || isset($datarow['excuses']) || isset($datarow['decision']) || isset($datarow['id_personal']) || isset($datarow['permission'])  || isset($datarow['untouchable']) 



if (isset($datarow['id_user'])){ if($datarow[$i]===$datarow['id_user'] ){  $hidden="class='hidden '";}}

if (isset($datarow['fr_role'])){  if($datarow[$i]===$datarow['fr_role'] ){  $hidden="class='hidden '";}}

if (isset($datarow['fr_title'])){  if($datarow[$i]===$datarow['fr_title'] ){  $hidden="class='hidden '";}}

if (isset($datarow['excuses'])){   if($datarow[$i]===$datarow['excuses'] ){  $hidden="class='hidden '";}}

if (isset($datarow['decision'])){  if($datarow[$i]===$datarow['decision'] ){  $hidden="class='hidden '";}}

if (isset($datarow['id_personal'])){  if($datarow[$i]===$datarow['id_personal'] ){ $hidden="class='hidden '";}}     

if (isset($datarow['permission'])){  if($datarow[$i]===$datarow['permission'] ){  $hidden="class='hidden '";}}

if (isset($datarow['untouchable'])){  if($datarow[$i]===$datarow['untouchable'] ){  $hidden="class='hidden '";}}

if (isset($datarow['cv'])){  if($datarow[$i]===$datarow['cv'] ){  $hidden="class='hidden '"; }}

if (isset($datarow['fr_job'])){  if($datarow[$i]===$datarow['fr_job'] ){ $hidden="class='hidden '"; }}

if (isset($datarow['ip_address'])){  if($datarow[$i]===$datarow['ip_address'] ){ $hidden="class='hidden '"; }}

if (isset($datarow['password'])){  if($datarow[$i]===$datarow['password'] ){ $hidden="class='hidden '"; }}

if (isset($datarow['seniority'])){  if($datarow[$i]===$datarow['seniority'] ){ $hidden="class='hidden '"; }}

if (isset($datarow['id_institute'])){  if($datarow[$i]===$datarow['id_institute'] ){ $hidden="class='hidden '"; }}


if (isset($datarow['permission_anticipated'])){  if($datarow[$i]===$datarow['permission_anticipated'] ){ $hidden="class='hidden '"; }}
if (isset($datarow['actual_month'])){  if($datarow[$i]===$datarow['actual_month'] ){ $hidden="class='hidden '"; }}
if (isset($datarow['state_consulting'])){  if($datarow[$i]===$datarow['state_consulting'] ){ $hidden="class='hidden '"; }}
                    
      
            
                if ( $i==5  && $feature=="consulting") {
                         $hidden="";
                    $dataresult=selecter("customer","id",$datarow[5],"name");

                        }

            


                        if ( $i==5  && $feature=="formation") {
                            $hidden="class='hidden'";
                       $dataresult="";
   
                           }
            


            if ( $i==4  && $feature=="user") {

                if($datarow[4]==0){

                    $dataresult="Déconnecté(e)";
                }else{

                    $dataresult="Connecté(e)";
                }

            }

            if ( $i==10  && $feature=="user") {

                if($datarow[10]==0){

                    $dataresult="Non";
                }else{

                    $dataresult="Oui";
                }

            }


            if ( $i==2 && $feature=="absence") {

                $theresult="test";
                if($datarow[1]==0){ $theresult="Injustifié";}
                if($datarow[1]==1){ $theresult="Maladie";}
                if($datarow[1]==2){ $theresult="Autres";}


                $dataresult=$theresult;

            }

            if ( $i==5  && $feature=="certificate" || $i==5 && $feature=="institute") {

                if($datarow[$i]==0){

                    $dataresult="Non";
                }else{

                    $dataresult="Oui";
                }

            }



            if ( $i==8  && $feature=="consulting") {

                if($datarow[$i]==1){

                    $dataresult="Paris";
                }
                
                
                if($datarow[$i]==2){

                    $dataresult="Toulouse";
                }


            }

            if ( $i==5  && $feature=="user") {

                if($datarow[5]==0){$dataresult=selecter("level","id",$datarow[5],"level_fr");}
                if($datarow[5]==1){$dataresult=selecter("level","id",$datarow[5],"level_fr"); }
                if($datarow[5]==2){$dataresult=selecter("level","id",$datarow[5],"level_fr"); }
                if($datarow[5]==3){$dataresult=selecter("level","id",$datarow[5],"level_fr"); }
                if($datarow[5]==4){$dataresult=selecter("level","id",$datarow[5],"level_fr");}
                if($datarow[5]==5){$dataresult=selecter("level","id",$datarow[5],"level_fr");}
            }


            $phone="";



            if ( $i==3  && $feature=="personal") { $phone="0"; }
            if ( $i==3  && $feature=="customer") { $phone="0"; }
            if ( $i==4  && $feature=="partner") { $phone="0"; }
            if ( $i==6  && $feature=="institute") { $phone="0"; }
            if ( $i==6  && $feature=="consulting") { $phone="0"; }
            if ( $i==6  && $feature=="user") { $phone="0"; }


            if ( ($i==3 || $i==4 || $i==6 || $i==7 || $i==8 || $i==9 || $i==19)  && $feature=="permission") { $dataresult=date('d/m/Y', strtotime($dataresult)); }
            if ( ($i==3 || $i==4 )  && $feature=="absence") { $dataresult=date('d/m/Y', strtotime($dataresult)); }
            if ( ($i==6 || $i==14 )  && $feature=="personal") { $dataresult=date('d/m/Y', strtotime($dataresult)); }
            if ( ($i==11 || $i==12 )  && $feature=="user") { $dataresult=date('d/m/Y', strtotime($dataresult)); }
            if ( ( $i==10 || $i==11 || $i==13)  && $feature=="consulting") { $dataresult=date('d/m/Y', strtotime($dataresult)); }
            if ( ( $i>=14 && $i<=20 )  && $feature=="formation") { $dataresult=date('d/m/Y', strtotime($dataresult)); }

            if ( $i==8 && $feature=="consulting") { 

                if($datarow[8]==1){ $dataresult="Paris"; }
                if($datarow[8]==2){ $dataresult="Toulouse"; }
                if($datarow[8]==3){ $dataresult="Vitrolles"; }


            }


            if($i==2 && $feature=="absence"){

                if($datarow[$i]==0){

                    $dataresult="Non justifié";

                }

                if($datarow[$i]==1){

                    $dataresult="Maladie";

                }

                if($datarow[$i]==2){

                    $dataresult="Autre";

                }
                


            }

            if ( $i==2 && $feature=="formation") { 

                $hidden="";
                $dataresult=finder($database,$datarow[$i],"customer","name");

            }

            if ( $i>=24 && $feature=="formation") { 

                $hidden="class='hidden'";

            }


            if ( $i==7 && $feature=="permission") { 

                $hidden="";

            }

 

            
            if ( $i==2 && $feature=="absence") { 

                $hidden="";

            }

            if ( $i==7 && $feature=="absence") { 

                $hidden="";

            }



            if ( $i==8 && $feature=="user") { 

                $hidden="";

            }

            if ( $i==13 && $feature=="user" || $i==8 && $feature=="consulting" || $i==12 && $feature=="personal") { 


                $hidden="";
                if($datarow[$i]==1){  $dataresult="Paris";  }
                if($datarow[$i]==2){  $dataresult="Toulouse"; }

            }

            
            if ( $i>=6 && $i<=9 && $feature=="permission") { 

                $hidden="class='hidden'";

            }

            if ( $i==10 && $feature=="permission") { 

                $hidden="";
                if($datarow[$i]=="permission"){  $dataresult="Congés payés";  }
                if($datarow[$i]=="family"){  $dataresult="Congés pour évènement familial"; }
                if($datarow[$i]=="nopaid"){  $dataresult="Congés sans solde"; }
                if($datarow[$i]=="anticipated"){  $dataresult="Congés par anticipation"; }
                if($datarow[$i]=="other"){  $dataresult="Autre motifs"; }

            }

            if ( $i==20 && $feature=="permission") { 

                $dataresult=date("d/m/Y",strtotime($datarow[$i]));

            }
            
                    echo "<li ".$hidden.">".$phone.str_replace("30/11/-0001","Non renseigné",$dataresult)."</li>";

                    

                }
              
            
               echo "</ul>";

               
                

               echo "</div>";
               echo "<div class='central'><button class='actionbutton' id='editdata'>Modifier les données</button></div>";
               echo "</div>";

               if($feature=="quotation"){

                $title="Modifer le prix de la prestation";
                $valuename="price";
                $featuremessage="La prestation n°".$id." du devis ".$datarow['id_'.$feature]." a bien été modifié";
                $quantity=$datarow['quantity'];

                EditValueform($title,$id,$feature,$valuename,$quantity,$featuremessage );



               }


               else{

                $hidden2="";


                if($feature=="permission"){

                    $hidden2="class='hidden'";

                }


                echo "<form id='sender' ".$hidden2." data-action='edittable' style='width:70%; margin:auto;' class='hidden' method='POST' action='' >";


                echo "<h3>Modifier les données</h3>";



                EditTableform($title,$id,$feature,"Les données ont été modifié");



                echo "<div class='central'><input type='submit' value='Valider'><span id='editcancel' style='margin-left:10px' class='actionbutton '>Annuler</span></div>";
                echo "</form>";
               }


           echo  '<script>$("#addtofeature").addClass("hidden");</script>';
               echo "</div>";


            
        }

        


      
  



    }


?>