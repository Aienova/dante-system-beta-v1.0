<?php


        $subject= " Nouvelle demande de formation ".$id;
        $textmessage= "

        <h1>Demande de formation</h1>
        
        <p>Une demande de formation a été ajouter par d'un de vos collaborateurs, voici ses informations :<p>
        
        
        <ul>
        <li><strong>ID Formation : </strong>".$id."</li>
        <li><strong>Nombre d'intérimaire(s) : </strong>".selecter("formation","id_formation",$id,"nb_consulting")."</li>
        <li><strong>Entreprise : </strong>".finder($database,selecter("formation","id_formation",$id,"id_customer"),"customer","name")."</li>
        <li><strong>Organisme de formation : </strong>".selecter("formation","id_formation",$id,"institute_name")."</li>
        <li><strong>Intitulé de formation : </strong>".selecter("formation","id_formation",$id,"certificate_name")."</li> 
        <li><strong>Début de contrat : </strong>".selecter("formation","id_formation",$id,"date_start")."</li> 
        <li><strong>Fin de contrat : </strong>".selecter("formation","id_formation",$id,"date_end")."</li> 
        <li><strong>Demande ajouter par : </strong>".selecter("formation","id_formation",$id,"sender")."</li>  
        
        </ul>
        
        <p>Veuillez procéder à la validation de cette demande, <a href='".$_SERVER['SERVER_NAME']."/formation'>cliquez-ici</a></p>
        
        <br><br>Bien cordialement<br><br>
        
        
        
        
        
        ".$signature;


        if(isset($mailtype)){




    if($mailtype==1){

        $subject= "Demande de formation ".$id." en attente d'une seconde validation ";
        $textmessage= "

        <h1>Demande de formation</h1>
        
        <p>Une demande de formation supérieur à ".selecter("dante_config","id",1,"higher_amount")."€, a été validée par un de vos collaborateurs, voici ses informations :<p>
        
        <ul>
        <li><strong>ID Formation : </strong>".$id."</li>
        <li><strong>Nombre d'intérimaire(s) : </strong>".selecter("formation","id_formation",$id,"nb_consulting")."</li>
        <li><strong>Entreprise : </strong>".finder($database,selecter("formation","id_formation",$id,"id_customer"),"customer","name")."</li>
        <li><strong>Organisme de formation : </strong>".selecter("formation","id_formation",$id,"institute_name")."</li>
        <li><strong>Intitulé de formation : </strong>".selecter("formation","id_formation",$id,"certificate_name")."</li> 
        <li><strong>Début de contrat : </strong>".selecter("formation","id_formation",$id,"date_start")."</li> 
        <li><strong>Fin de contrat : </strong>".selecter("formation","id_formation",$id,"date_end")."</li> 
        <li><strong>Demande ajouter par : </strong>".selecter("formation","id_formation",$id,"sender")."</li>  
        <li><strong>1re validation par : </strong>".selecter("formation","id_formation",$id,"validator")."</li>  
        
        </ul>
        
        <p>Veuillez procéder à la seconde validation de cette demande, <a href='".$_SERVER['SERVER_NAME']."/formation'>cliquez-ici</a></p>
        
        <br><br>Bien cordialement<br><br>
        
        ".$signature;
    }

    if($mailtype==2){

        $subject= " Demande de formation ".$id."  validée";
        $textmessage= "

        <h1>Demande de formation</h1>
        
        <p>La demande de formation ".$id." a été validée par ".selecter("formation","id_formation",$id,"validator")."</p>
        
        
        <p>Pour la consulter en cliquant-ici, <a href='".$_SERVER['SERVER_NAME']."/formation'>cliquez-ici</a></p>
        
        <br><br>Bien cordialement<br><br>
        
        ".$signature;
    }

    if($mailtype==3){

        $subject= " Dante System : Demande de formation ".$id."   rejetée ";
        $textmessage= "

        <h1>Demande de formation</h1>
        
        <p>La demande de formation ".$id." a été rejetée par ".selecter("formation","id_formation",$id,"validator")."</p>
        
        <p><strong>Raison du refus :</strong><br>".selecter("formation","id_formation",$id,"excuses")."</p>
        
        <p>Pouvez la consulter en cliquant-ici, <a href='".$_SERVER['SERVER_NAME']."/formation'>cliquez-ici</a></p>
        
        <br><br>Bien cordialement<br><br>
        
        ".$signature;
    }


    if($mailtype==4){

        if(isset($sendername)){

            $sender=$sendername;
            
        }else{

                $sender="un consultant APPI";
            
        }

        $subject= " Dante System : Demande de formation à revoir ".$id;
        $textmessage= "

        <h1>Demande de formation</h1>
        
        <p>La demande de formation ".$id." a été renvoyé pour une nouvelle validation par ".$sender."</p>
        
        <p><strong>Commentaire :</strong><br>".selecter("formation","id_formation",$id,"comment")."</p>
        
        <p>Pouvez la consulter en cliquant-ici, <a href='".$_SERVER['SERVER_NAME']."/formation'>cliquez-ici</a></p>
        
        <br><br>Bien cordialement<br><br>
        
        ".$signature;
    }


}



$mail ->Subject = $subject;

$mail ->Body = $textmessage;




?>