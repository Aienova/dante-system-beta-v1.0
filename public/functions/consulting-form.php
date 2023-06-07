



<?php  

if(isset($_POST['newnb'])){

    $counter=$_POST['newnb'];
}else{

    $counter=1;
}

/*
echo "<input type='hidden' name='firstname' value='deus'/>";
echo "<input type='hidden' name='surname' value='ex machina'/>";
echo "<input type='hidden' name='date_birth' value=''/>";
echo "<input type='hidden' name='hourly_rate' value='777'/>";
echo "<input type='hidden' name='date_contrat_start' value=''/>";
echo "<input type='hidden' name='date_contrat_end' value=''/>";
*/



for($i=1;$i<=$counter;$i++){


echo '<div class="add-new-consulting" id="new-consulting-'.$i.'">
<strong>Stagiare n°'.$i.'<br></strong>
<input type="hidden" name="nb_consulting" value="0" />
<input type="hidden" name="id_consulting_'.$i.'" value="0" />
    <label>NOM et Prénom</label><input type="text" style="text-transform:uppercase" placeholder="Nom" name="new-surname-'.$i.'" /><input type="text" style="margin-left:10px" style="text-transform:capitalize" placeholder="Prénom" name="new-firstname-'.$i.'" /><br>
    <label>Date de naissance</label><input type="date"  name="new-date_birth-'.$i.'" />
    <label>Taux horaire</label><input type="number" name="new-hourly_rate-'.$i.'" />
    <label>Début de contrat</label><input type="date" name="new-date_contrat_start-'.$i.'" />
    <label>Fin de contrat</label><input type="date" name="new-date_contrat_end-'.$i.'" />
</div>';


 } 
 
 
 ?>

