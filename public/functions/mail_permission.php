<?php


$subject = " Dante System : Demande de congé envoyé le ".date('d/m/Y-h:i:s');

$textmessage= "

<h1>Demande de congé</h1>

<p>Une demande de congé a été créer par un de vos collaborateurs, voici ses informations :<p>

<ul>
<li><strong>ID Congé : </strong>".laster($database,"permission","id_permission")."</li>
<li><strong>Nom du salarié : </strong>".laster($database,"permission","personal_name")."</li>
<li><strong>Date de début : </strong>".date("d/m/Y",strtotime(laster($database,"permission","date_start")))."</li>
<li><strong>Date de fin : </strong>".date("d/m/Y",strtotime(laster($database,"permission","date_end")))."</li>

</ul>

<p>Veuillez procéder à la validation finale de cette demande, <a href='".$_SERVER['SERVER_NAME']."/permission'>cliquez-ici</a></p>

<br><br>Bien cordialement<br><br>


".$signature;

if(isset($mailtype)){

if($mailtype==2){

    $subject= " Dante System : Demande de congé validée le ".date('d/m/Y-h:i:s');
    $textmessage= "

    <h1>Demande de congé</h1>
    
    <p>La demande de congé ".$id." a été validée par ".selecter("permission","id_permission",$id,"validator")."</p>
    
    
    <p>Pour la consulter , <a href='".$_SERVER['SERVER_NAME']."/permission'>cliquez-ici</a></p>
    
    <br><br>Bien cordialement<br><br>
    
    ".$signature;
}


if($mailtype==3){

    $subject= " Dante System : Demande de congé rejetée le ".date('d/m/Y-h:i:s');
    $textmessage= "

    <h1>Demande de congé</h1>
    
    <p>La demande de congé ".$id." a été rejetée par ".selecter("permission","id_permission",$id,"validator")."</p>

    <p><strong>Raison du refus :</strong><br>".selecter("permission","id_permission",$id,"excuses")."</p>
    
    
    <p>Pour faire appel de cette décision,  <a href='".$_SERVER['SERVER_NAME']."/permission'>cliquez-ici</a></p>
    
    <br><br>Bien cordialement<br><br>
    
    ".$signature;
}


if($mailtype==4){

    if(isset($sendername)){

        $sender=$sendername;
        
    }else{

            $sender="un consultant APPI";
        
    }


    $subject= " Dante System : Demande de congé à revoir ".date('d/m/Y-h:i:s');
    $textmessage= "

    <h1>Demande de congé </h1>

    
    <p>La demande de congé ".$id." a été renvoyé pour une nouvelle validation par ".$sender."</p>
    
    <p><strong>Commentaire :</strong><br>".selecter("permission","id_permission",$id,"comment")."</p>
    
    <p>Pouvez la consulter en cliquant-ici, <a href='".$_SERVER['SERVER_NAME']."/permission'>cliquez-ici</a></p>
    
    <br><br>Bien cordialement<br><br>
    
    ".$signature;
}

}

$mail ->Subject = $subject;

$mail ->Body = $textmessage;



?>