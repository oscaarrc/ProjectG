<?php
    function conectarBD(){
        $db = mysqli_connect('localhost','root','','projectg');
        if (!$db){
            exit;
        }else{
            return $db;
        }
    }
?>