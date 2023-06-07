<?php

include 'functions.php';
include 'database.php';


function Multi_Lister_consulting($message,$database,$feature,$relation){


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
  
                      $dataname=$data['name'];
                  }else{
  
                    $dataname=strtoupper($data['surname'])." ".ucfirst($data['firstname']);
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
  

  }

  
  if(checker("customer","name",$_POST['costumername'])==1){

    $idcostumer=selecter("customer","name",$_POST['costumername'],"id");
  
    echo Multi_Lister_consulting("Liste des intérimaires ",$database,"consulting",$idcostumer);


  }else{

    echo "<span>Aucun intérimaires n'a été enregistré à cette entreprise, veuillez les ajouter ci-dessous :</span>";
    echo "<br><br><label>Nombres de intérimaires :</label><input id='new-nb-consulting' type='number' min='1' name='new-nb-consulting'  /><span class='actionbutton' id='displaylist'>Afficher</span> ";
    echo "<div id='addnewconsulting'>";
    include "consulting-form.php";
    echo "</div>";

  }


?>

<script>

$(".checkthis").click(function() {

var feature = $(this).closest(".checkthis").attr("data-feature");
var count=parseInt($("#counter").attr("value"));


if($(this).closest(".checkthis").hasClass("checked")){


    count=count-1;

    if(count==0){

        $(".checkthis").attr("name","");

    }else{

      $(".checkthis").attr("name","id_"+feature+"_"+count);

    }



    $(this).closest(".checked").attr("name","");

$(this).closest(".checkthis").removeClass("checked");

$("#counter").val(count);

  

}else{

  count=count+1;

  $(this).closest(".checkthis").attr("name","id_"+feature+"_"+count);
$(this).closest(".checkthis").addClass("checked");


$("#counter").val(count);


}




});


$("#displaylist").click(function() {

var newnb=$("#new-nb-consulting").val();

console.log("Organisme:"+newnb);


  $.ajax({
    url: "./functions/consulting-form.php",
      type: "POST",
data: { 
  newnb : newnb,
},

success: function(data) {

$("#addnewconsulting").html(data);

},

error: function() {

$("#addnewconsulting").text("Erreur au niveau des fonctions");
}

    });
});

</script>