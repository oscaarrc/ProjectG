<?php
    require "./Database/databases.php";
    $db = conectarBD();
    $errores=[];
    
    $uid='';
    $password='';

    //validación del formulario
    if($_SERVER['REQUEST_METHOD']==='POST'){
        //sanitizamos datos
        $uid=mysqli_real_escape_string($db, $_POST['ID']);
        $password=mysqli_real_escape_string($db, $_POST['Password']);
        //comprobamos errores
        if(!$uid){
            $errores[]="El uid no es válido";
        }
    
        if(!$password){
            $errores[]="La contraseña no es válida";
        }
    //en caso de no haber errores
        if(empty($errores)){
            //revisar si el usuario existe
            $query="SELECT * FROM player WHERE ID = '$uid';";
            $resultado= mysqli_query($db, $query);
            if ($resultado->num_rows){
                //revisar si el password es correcto
                $usuario=mysqli_fetch_assoc($resultado);
                //nos devolverá true o false en el caso de que el password guardado en la bd sea igual al pasado por post
                $auth=password_verify($password, $usuario["passw"]);
                //var_dump($auth);
                if($auth){
                    //el usuario está autentificado
                    session_start();
                    $_SESSION["usuario"] = $usuario["ID"];
                    $_SESSION["login"] = true;
                    $_SESSION['nombre']=$usuario["usrName"];
                    $_SESSION['desc']=$usuario['usrDescription'];
                    $_SESSION['RA']=$usuario["lvl"];
                    $_SESSION['NM']=$usuario["WorldLevel"];

                    $sesion=$_SESSION["usuario"];

                    $queryteam1= "SELECT * FROM teams where id_team=1 and player_uid='$sesion';";
                    $queryteam2= "SELECT * FROM teams where id_team=2 and player_uid='$sesion';";
                    $queryteam3= "SELECT * FROM teams where id_team=3 and player_uid='$sesion';";
                    $queryteam4= "SELECT * FROM teams where id_team=4 and player_uid='$sesion';";


                    

                    $consteam1=mysqli_query($db, $queryteam1);
                    $consteam2=mysqli_query($db, $queryteam2);
                    $consteam3=mysqli_query($db, $queryteam3);
                    $consteam4=mysqli_query($db, $queryteam4);

                    if($consteam1->num_rows!=0){
                        while($row = mysqli_fetch_array($consteam1)){
                            $ruta1="IMG/img_banner/".$row[3]."_banner.png";
                            $ruta2="IMG/img_banner/".$row[4]."_banner.png";
                            $ruta3="IMG/img_banner/".$row[5]."_banner.png";
                            $ruta4="IMG/img_banner/".$row[6]."_banner.png";
                        $_SESSION['equipo']=[$ruta1, $ruta2, $ruta3, $ruta4, 0, 0, 0, 0];
                        }
                    } else{
                        $_SESSION['equipo']=['IMG/plus.png', 'IMG/plus.png', 'IMG/plus.png', 'IMG/plus.png', 0, 0, 0, 0];
                    }
                    if($consteam2->num_rows!=0){
                        while($row2 = mysqli_fetch_array($consteam2)){
                            $ruta1="IMG/img_banner/".$row2[3]."_banner.png";
                            $ruta2="IMG/img_banner/".$row2[4]."_banner.png";
                            $ruta3="IMG/img_banner/".$row2[5]."_banner.png";
                            $ruta4="IMG/img_banner/".$row2[6]."_banner.png";
                            $_SESSION['equipo2']=[$ruta1, $ruta2, $ruta3, $ruta4, 0, 0, 0, 0];
                            }
                    } else{
                        $_SESSION['equipo2']=['IMG/plus.png', 'IMG/plus.png', 'IMG/plus.png', 'IMG/plus.png', 0, 0, 0, 0];
                    }
                    if($consteam3->num_rows!=0){
                        while($row3 = mysqli_fetch_array($consteam3)){
                            $ruta1="IMG/img_banner/".$row3[3]."_banner.png";
                            $ruta2="IMG/img_banner/".$row3[4]."_banner.png";
                            $ruta3="IMG/img_banner/".$row3[5]."_banner.png";
                            $ruta4="IMG/img_banner/".$row3[6]."_banner.png";
                            $_SESSION['equipo3']=[$ruta1, $ruta2, $ruta3, $ruta4, 0, 0, 0, 0];
                            }
                    } else{
                        $_SESSION['equipo3']=['IMG/plus.png', 'IMG/plus.png', 'IMG/plus.png', 'IMG/plus.png', 0, 0, 0, 0];
                    }
                    if($consteam4->num_rows!=0){
                        while($row4 = mysqli_fetch_array($consteam4)){
                            $ruta1="IMG/img_banner/".$row4[3]."_banner.png";
                            $ruta2="IMG/img_banner/".$row4[4]."_banner.png";
                            $ruta3="IMG/img_banner/".$row4[5]."_banner.png";
                            $ruta4="IMG/img_banner/".$row4[6]."_banner.png";
                            $_SESSION['equipo4']=[$ruta1, $ruta2, $ruta3, $ruta4, 0, 0, 0, 0];
                            }
                    } else{
                        $_SESSION['equipo4']=['IMG/plus.png', 'IMG/plus.png', 'IMG/plus.png', 'IMG/plus.png', 0, 0, 0, 0];
                    }

                    
                    
                    
                    
                    header("Location: /index.php?id_team=1");
                }
                else{
                    $errores[]= "La contraseña es incorrecta";
                }            
            }
            else{
                $errores[]="El usuario no existe";
            }
        }
    
    }
    
    ?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>ProjectG</title>
</head>
<body>
    <header>
        <div class="Titulo1">
            <img src="./IMG/logof.png" alt="logo" class="logo">
        </div>
    </header>
    <main>
    
    <form method="POST" class="formulario">
        <div class="contenedor">
            <div class="Iniciar">
                <h3>Iniciar sesión</h3>
            </div>
            <div class="bloque-contenedor">
                <?php 
                foreach($errores as $error){ ?>
                    <div class="error">
                        <?php echo $error;?>
                    </div>
                <?php
                }
            ?>
                <div class="uid">
                <label for="uid">UID:</label>
                <input type="text" id="uid" name="ID" required>
                </div>
                <div class="password">
                    <label>Password: </label>
                    <input type="text" id="password" name="Password" required>
                </div>
            </div>
            <a href="" class="boton">
                <button type="submit" class="boton">Iniciar sesión</button>
            </a>
            <label class="noacc">¿No tienes cuenta?<a href="crearcuenta.php" class="crear">Crear cuenta</a></label>
            
        </div>
    </form>    
    </main>
</body>
</html>