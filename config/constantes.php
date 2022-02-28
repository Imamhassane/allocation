<?php
//Chemin des Dossier 
  define("ROOT", str_replace("public".DIRECTORY_SEPARATOR."index.php","",$_SERVER['SCRIPT_FILENAME']));
  
  define("PATH_VIEWS",ROOT."templates".DIRECTORY_SEPARATOR);
  define("PATH_VIEWS_INC",ROOT."templates".DIRECTORY_SEPARATOR."inc".DIRECTORY_SEPARATOR);
  //Dossier Public
   //  define("WEBROOT","http://localhost:8000/");
 define("WEBROOT","http://allocationchambre.alwaysdata.net/");
  define("per_page_record",5);
 define("per_page_record2",2);
     /**/
 define("per_page_record3",4); 

   