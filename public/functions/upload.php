<?php
include_once("database.php");
include_once("functions.php");

   /* Getting file name */
   $filename = $_FILES['myfile']['name'];
   $directory ="";


   if(isset($_POST['directory']) || isset($_POST['codename'])  ){

      $directory=$_POST['directory']."/";

      
      $filename=$_POST['codename'].".pdf";

   }

   if(isset($_POST['parent_folder'])){

      $directory=$_POST['parent_folder'];

   }




   if (substr($directory, 0, 1) != '/') {

      $directory="/".$directory;
   }

   

   
   /* Location */
   $location = "../../public/build/library".$directory.$filename;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

   /* Valid extensions */
   $valid_extensions = array("jpg","jpeg","png","pdf");

   $response = "Fichier invalide ou trop lourd :".$location;
   /* Check file extension */
   if(in_array(strtolower($imageFileType), $valid_extensions)) {

      /* Upload file */
      if(move_uploaded_file($_FILES['myfile']['tmp_name'],$location)){


         if(isset($_POST['directory']) || isset($_POST['codename'])  ){

            
            EditValue($_POST['table'],$_POST['directory'],1,0,$_POST['id']);
      
         }
      


         $response = "Fichier enregistré :".$location;
      }
   }

   echo $response;





