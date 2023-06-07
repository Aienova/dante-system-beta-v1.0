<tr class="the_agency"><th>Vitrolles</th></tr>

    <?php 
   
   /*---------------------------------------------------AGENCE DE VITROLLES----------------------------------------------------------*/
        
   $query="SELECT * FROM personal WHERE id_agency=3";
   $request = $database->prepare($query);
   $request->execute();
   

   
   while($data=$request->fetch()){


    echo "<tr>";
        for($d=0;$d<=$days;$d++){



            $result="";
            $event="work";

            if($d<10){

                $digit="0";
            }else{

                $digit="";
            }

            if($d==0){

                $result=$data['firstname'];
                $event="";
            }

            $dateconstruct=date('Y')."-".date('m')."-".$digit.$d;


       


            if(isholiday(strtotime($dateconstruct))==1){

                $event="holiday";
            }

            if(isWeekend($dateconstruct)==1){

                $event="weekend";
            }


            

            echo "<td id='p".$data['id']."-".date('Y')."-".date('m')."-".$digit.$d."'  class='".$event."'>".$result."</td>";
        }

        $firstday=date("Y")."-".date("m")."-01";

        $lastday=dater(strtotime($firstday), strtotime(date("Y-m-d")))+1 ;

        $permissions=nb_permissions_month($data['id'],date('Y-m'));
        $diseases=nb_diseases_month($data['id'],date('Y-m'));

        echo "<td class='permissions'>".$permissions."</td>";
        echo "<td class='diseases'>".$diseases."</td>";
        echo "<td class='presences'>".$lastday-($permissions+$diseases)."</td>";

        echo "</tr>";
    }


    
           /*---------------------------------------------------AGENCE DE VITROLLES----------------------------------------------------------*/
        ?>