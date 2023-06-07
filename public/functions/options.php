<?php

include_once("database.php");
include_once("functions.php");


        $notification="<img class='small-icon' src='build/media/icons/bell.png' />";
        $permission="<strong>Congé restant :7</strong>";
        $level="<strong style='margin-left:5px;'>Niveau : Editeur</strong>";


        echo "<div id='optionlist'>

        <span>".$notification."</span>
        <span>".$permission."</span>
        <span>".$level."</span>
       

        </div>";

        
        

?>