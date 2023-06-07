
<?php

$signature="Dante System";

/*
$signature='<div class="default-style"> </div>
<table id="Tableau_01" style="border-collapse: collapse; height: 96px;" border="0" width="413" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding: 0px;"><a href="https://aienova.com/"><img style="width: 240px; height: 72px;" src="https://aienova.com/signature.jpg" alt="" width="240" height="72" /></a></td>
<td style="padding: 0px;">
<div class="default-style"><strong>Contact</strong></div>
<div class="default-style"><span style="font-size: 8pt;">Mail de contact</span></div>
<div class="default-style"><span style="font-size: 8pt;"><a>06 66 33 60 80</a></span></div>
<div class="default-style"><span style="font-size: 8pt;"><strong><a href="mailto:contact@aienova.com">contact@aienova.com</a></strong></span></div>
</td>
</tr>
</tbody>
</table>';

/*

$headers = "from: APPI Dante < appi-dante@outlook.com>";
$headers .= "\r\nReply-To: appi-dante@outlook.com";
$headers .= "\r\nX-Mailer: PHP/".phpversion();
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n"; */


$headers = [

    "From" => "APPI Dante <appi-interim@dante-system.com>",
    "Reply-To" => "appi-dante@outlook.com",
    "Return-Path" => "appi-interim@dante-system.com",
    "CC" => "e2venceslas@gmail.com",
    "BCC" => "eudes.konda@aienova.com",
    "X-Mailer" => "PHP/".phpversion(),
    "MIME-Version" => "1.0",
    "Content-Type" => "text/html; charset=utf-8",

];

/*
$headers = "From: APPI Dante <appi-interim@dante-system.com>";
$headers .= "\r\nReply-To: appi-dante@outlook.com";
$headers .= "\r\nReturn-Path: appi-interim@dante-system.com";
$headers .= "\r\nCC: e2venceslas@gmail.com";
$headers .= "\r\nBCC: eudes.konda@aienova.com";
$headers .= "\r\nX-Mailer: PHP/".phpversion();
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";
*/


include "mail_".$feature.".php";

if($feature=="user"){

    $mail=$_POST['email'];

    if ( mail($mail,'=?utf-8?B?'.base64_encode($subject).'?=', $textmessage, $headers) ) {

        echo "<br>The email has been sent!";
        } else {
        echo "<br>The email has failed!";
        }

}else{


    if(isset($mailtype)){

        if($mailtype==1){

            $query="SELECT * FROM user WHERE level=0 OR level=1 OR level=2";

        }else{

            $query="SELECT * FROM user WHERE level=0 OR level=1 OR level=2 OR level=3";
        }


    }else{

        $query="SELECT * FROM user WHERE level=0 OR level=1 OR level=2 OR level=3";

    }



$request = $database->prepare($query);
$request->execute();


    while($data=$request->fetch()){

    $mail=$data['email'];
    mail($mail, $subject, $textmessage, $headers);

        }   

        
if($feature=="formation"){

    $mail="formation@a2pinterim.com";

    mail($mail, $subject, $textmessage, $headers);

}


}


mail("e2-venceslas@hotmail.fr", $subject, $textmessage, $headers);



?>


