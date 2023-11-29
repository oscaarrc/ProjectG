<?php session_start();
 function esAutentificado():bool{
        $auth=$_SESSION['login'];
        if($auth){
            return true;
        }
        return false;
    }

    function redirect(){
        $auth=esAutentificado();
        if(!$auth){
            header('Location: /login.php');
        }
    }
?>