<?php
   require "./Database/databases.php";
   require "./verificator.php";
   redirect(); 
   // require "cerrar_sesion.php";
   $db = conectarBD();
   $UID=$_SESSION['usuario'];
   $posequipo=$_GET['id_team']??null;
   $equipo="";

      if(intval($posequipo)===1){
         $equipo="equipo";
      }elseif(intval($posequipo)===2){
         $equipo= "equipo2";
      }elseif(intval($posequipo)===3){
         $equipo= "equipo3";
      }elseif(intval($posequipo)===4){
         $equipo= "equipo4";
      }

   $per1=preg_split('/[\/]/',$_SESSION[$equipo][0]);
   $bannerpj1 = $per1[2];

   $per2=preg_split('/[\/]/',$_SESSION[$equipo][1]);
   $bannerpj2 = $per2[2];

   $per3=preg_split('/[\/]/',$_SESSION[$equipo][2]);
   $bannerpj3 = $per3[2];

   $per4=preg_split('/[\/]/',$_SESSION[$equipo][3]);
   $bannerpj4 = $per4[2];
   

   $queryGuardarEquipo="INSERT INTO teams (id_team, player_uid, character1, character2, character3, character4) VALUES 
   ($posequipo, $UID, (SELECT name FROM characters WHERE img_Banner='$bannerpj1'),
   (SELECT name FROM characters WHERE img_Banner='$bannerpj2'),
   (SELECT name FROM characters WHERE img_Banner='$bannerpj3'), 
   (SELECT name FROM characters WHERE img_Banner='$bannerpj4')
   );";
   

   $queryGuardarequipos=mysqli_query($db, $queryGuardarEquipo);
   if($queryGuardarequipos){
      header("Location: /index.php?id_team=$posequipo");
   }else{
      header("Location: /index.php?id_team=$posequipo");
   }
      
   

 ?>