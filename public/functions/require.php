<?php
        if(isset($_POST['name'])){if($_POST['name']==""){echo "Veuillez donner un nom";exit;}}
        if(isset($_POST['surname'])){if($_POST['surname']==""){echo "Veuillez donner un nom de famille";exit;}}
        if(isset($_POST['firstname_contact'])){if($_POST['firstname_contact']==""){echo "Veuillez donner un prénom à votre interlocuteur";exit;}}
        if(isset($_POST['surname_contact'])){if($_POST['surname_contact']==""){echo "Veuillez de donner un nom de famille à votre interlocuteur";exit;}}
        if(isset($_POST['firstname'])){if($_POST['firstname']==""){echo "Veuillez donner un prénom";exit;}}
        if(isset($_POST['role'])){if($_POST['role']==""){echo "Veuillez donner un poste";exit;}}
        if(isset($_POST['qualiopi_number'])){if($_POST['qualiopi_number']==""){echo "Veuillez donner un numéro qualiopi";exit;}}
        if(isset($_POST['speciality'])){if($_POST['speciality']==""){echo "Veuillez donner un métier";exit;}}
        if(isset($_POST['login'])){if($_POST['login']==""){echo "Veuillez rentrer un identifiant";exit;}}
        if(isset($_POST['password'])){if($_POST['password']==""){echo "Veuillez rentrer un mot de passe ";exit;}}
        if(isset($_POST['hourly_rate'])){if($_POST['hourly_rate']=="" && $feature!="formation"){echo "Veuillez définir le taux horaire ";exit;}}
        if(isset($_POST['hour'])){if($_POST['hour']=="" && $feature!="formation"){echo "Veuillez rentrer le nombre d'heure ";exit;}}
        if(isset($_POST['cost'])){if($_POST['cost']=="" && $feature!="formation"){echo "Veuillez définir le coût pédagogique ";exit;}}
        if(isset($_POST['email'])){if($_POST['email']==""){echo "Veuillez rentrer une adresse email ";exit;} if(!str_contains($_POST['email'],'@')){echo "Adresse email invalide ";exit;}}
   

?>