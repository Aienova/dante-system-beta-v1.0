
<?php

include 'database.php';
        
$query="SHOW COLUMNS FROM ".$feature;

$query2="SELECT * FROM ".$feature." WHERE id_".$feature."='".$id."'";



$column = $database->prepare($query);
$row = $database->prepare($query2);
$column->execute();
$row->execute();


  $i=0;


  $datarow = $row->fetch();


while ($columndata = $column->fetch()){

        

        if($columndata['Field']=='date_contrat_start' || $columndata['Field']=='hour' || $columndata['Field']=='date_contrat_end' || $columndata['Field']=='cost' || $columndata['Field']=='date_birth'  || $columndata['Field']=='hourly_rate' || $columndata['Field']=='amount' || $columndata['Field']=='wage'  || $columndata['Field']=='consulting_name'  || $columndata['Field']=='service' || $columndata['Field']=='quantity' || $columndata['Field']=='price' || $columndata['Field']=='id_consulting'   ){


            $field=$columndata['Field'];


            $query3=" SELECT ".$field." FROM ".$feature." WHERE id_".$feature."='".$id."'";
          
            $multirow= $database->prepare($query3);
            $multirow->execute();

            $concat="";
            $concat2="";
            $total=0;

           

            while($datamultirow = $multirow->fetch()){

               
                


                if($field=='amount' || $field=='cost'){

                    $total+= $datamultirow[$field];
    
                }else{


                    if($field=='date_contrat_start' || $field=='date_contrat_end' || $field=='date_birth'){

                    $concat.=date('d/m/Y',strtotime($datamultirow[$field]))."<br>";
                }else{


                    if($field=='id_consulting'){

                        $concat.=finder($database,$datamultirow[$field],"consulting","hour")."<br>";

                    }else{


                        $concat.=$datamultirow[$field]."<br>";


                    }


                }

                    

                }


                if($field=="consulting_name"){

                    $concat2.=$datamultirow[$field].",";

                }

                    }




                    if($columndata['Field']=="consulting_name"){


                        echo ".replace('[[interns]]','".$concat2.",')";
            
            
            
                    }

                    if($columndata['Field']=="id_consulting"){


                        echo ".replace('[[hour.appi]]','".$concat.",')";
            
            
            
                    }

                    if($columndata['Field']=="cost"){

                        echo ".replace('[[".$columndata['Field']."]]','".$total."')";

                    }


                    
                    if($columndata['Field']=="amount"){

                        echo ".replace('[[".$columndata['Field']."]]','".$total."')";

                    }else{

                        echo ".replace('[[".$columndata['Field']."]]','".$concat."')";
                    }




            


            if($field=='amount'){

                $tva=round($total*20/100,2);
                $totalttc=round($total+$tva,2);
                

                echo ".replace('[[total]]','".$total."')";
                echo ".replace('[[tva]]','".$tva."')";
                echo ".replace('[[totalttc]]','".$totalttc."')";

            }

        }else{


            if (in_array($columndata['Field'], ['decision', 'paid'])) {

                if($feature=="formation"){

                    $decision=1;
                }else{

                    $decision=$datarow['decision'];

                }

                if($feature=="permission"){


                    $thedata=$datarow['paid'];

                    
                }




            }else{




                if(str_contains($columndata['Field'],'date')){

                        if(strtotime($datarow[$i])<0){

                    $thedata="Non renseigné";

                        }else{

                            $thedata=date('d/m/Y',strtotime($datarow[$i]));
                        }


                    


                }else{

                    $thedata=$datarow[$i];

                }


                
            }



            echo ".replace('[[".$columndata['Field']."]]','".$thedata."')";

        }


        if($columndata['Field']=="date_end" && $feature=="formation"){

            if(strtotime($datarow[14])>0 && strtotime($datarow[15])>0 ){

                echo ".replace('[[formation.length]]','".dater(strtotime($datarow[14]),strtotime($datarow[15]))." jours')";

            }
            echo ".replace('[[formation.length]]','Donnée indisponible')";


        }

  

        if($feature=="permission"){


            $idpersonal=selecter("permission","id_permission",$_POST['featureid'],"id_personal");
            $resultcount=selecter("permission","id_permission",$_POST['featureid'],"left_permission")-selecter("permission","id_permission",$_POST['featureid'],"total_count_permission");
            $idagency=selecter("personal","id",$idpersonal,"role");

            if($idagency==2){

                $agency="Toulouse";

            }else{

                $agency="Paris";

            }
    
            echo ".replace('[[personal_surname]]','".selecter("personal","id",$idpersonal,"surname")."')";
            echo ".replace('[[personal_firstname]]','".selecter("personal","id",$idpersonal,"firstname")."')";
            echo ".replace('[[role]]','".selecter("personal","id",$idpersonal,"role")."')";
            echo ".replace('[[agency]]','".$agency."')";
            echo ".replace('[[result_permission]]','".$resultcount."')";
     
        }

            $i=$i+1;
      
}


/*----CUSTOMER DATA ---------*/




if($feature=='permission'){

    $target='personal';

    
}else{

    $target='customer';
}
    


$query4="SHOW COLUMNS FROM ".$target;
$query5="SELECT * FROM ".$target." WHERE id =".$datarow['id_'.$target];



$query6="SHOW COLUMNS FROM company";
$query7="SELECT * FROM company ";
$featurecl = $database->prepare($query4);
$featurecl->execute();
$featuretable = $database->prepare($query5);
$featuretable->execute();
$companycl = $database->prepare($query6);
$companycl->execute();
$company = $database->prepare($query7);
$company->execute();

$x=0;
$y=0;

$featuredata = $featuretable->fetch();
$companydata = $company->fetch();

while($featurecldata = $featurecl->fetch()){



    echo ".replace('[[".$target.".".$featurecldata['Field']."]]','".$featuredata[$x]."')";

    $x=$x+1;

}


while($companycldata = $companycl->fetch()){

    echo ".replace('[[company.".$companycldata['Field']."]]','".$companydata[$y]."')";

    $y=$y+1;

}








?>