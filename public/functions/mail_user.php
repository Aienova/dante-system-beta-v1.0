<?php

$subject= " Bienvenue sur Dante System";

$textmessage= "

<h1>Bonjour ".laster($database,"user","firstname")." ".laster($database,"user","surname").", bienvenue sur Dante</h1>

<p>Vos collaborateurs vous ont crée un compte sur Dante system, voici ses informations :<p>

<ul>
<li><strong>identifiant : </strong>".laster($database,"user","login")."</li>
<li><strong>Mot de passe : </strong>".$_POST['password']."</li>
<li><strong>Niveau : </strong>".laster($database,"user","level")."</li>

</ul>

<p>Pour vous connecter à votre compte, <a href='".$_SERVER['SERVER_NAME']."/connection'>cliquez-ici</a></p>

<br><br>Bien cordialement<br><br>


".$signature;


$mail ->Subject = $subject;

$mail ->Body = $textmessage;

?>