<?php
require "./Database/databases.php";
    $errores=[];
    $db=conectarBD();
    define('MEDIDA', 1024);



    // Generar un número aleatorio de 8 dígitos
    $numeroAleatorio = mt_rand(100000000, 999999999);

    // Agregar un 7 al principio del número
    $uid = "7" . substr($numeroAleatorio, 1);
    $name = '';
    $password ='';
    $ra ='';
    $nm ='';
    $description ='';
    
    if ($_SERVER['REQUEST_METHOD']==="POST"){
        //comprobamos los datos
        $name = $_POST['name'];
        $password= $_POST['password'];
        $ra= $_POST['ra'];
        $nm=$_POST['nm'];
        $description= $_POST['description'];

        if (!$uid) {
            $errores[]="No existe ningún uid";
        }
        else if (!$name) {
            $errores[]="Debes añadir un nombre de usuario";
        }
        else if (!$password) {
            $errores[]="Debes añadir una contraseña";
        }
        else if (!$ra) {
            $errores[]="Debes añadir un rango de aventura";
        }
        else if (!$nm) {
            $errores[]="Debes añadir un nivel de mundo";
        }
        else if (!$description) {
            $errores[]="Debes añadir una descripción";
        }

        //ahora es donde realmente insertamos los valores en la bd. Solo se introduce el campo si el array de errores está vacío
        if(empty($errores)){
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $query="INSERT INTO player (ID, passw, usrName, lvl, WorldLevel, usrDescription) VALUES 
            ('$uid', '$password_hash', '$name', '$ra','$nm','$description');";
            $resultado=mysqli_query($db,$query);
            echo $query;

            if ($resultado) {
                header('Location: /login.php');
                
            }
        }
    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="crearcuenta.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="Titulo1">
            <img src="./IMG/logof.png" alt="logo" class="logo">
        </div>
    </header>
    <main>
    <form method="POST">
    <div class="contenedor">
            <div class="crear">
                <h3>Crear Cuenta</h3>
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
                        <label>UID: </label> <p id="UID" name="UID"><?php echo $uid?></p>
                    </div>
                    <div class="password">
                        <label>Nombre: </label> <input type="text" id="name" name="name">
                    </div>
                    <div class="password">
                        <label>Contraseña: </label> <input type="text" id="password" name="password">
                    </div>
                </div>
                <div class="datos">
                    <div class="RA">
                        <label class="ra">RA:</label> 
                        <input type="number" name="ra" min="1" max="60" id="ra" name="ra">
                    </div>
                    <div class="NM">
                        <label class="nm">NM:</label>
                        <input type="number" name="nm" min="1" max="8" id="nm" name="nm">
                    </div>
                </div>
                <div class="descripcion">
                    <label class="Desc">Descripción:</label>
                    <input type="text" id="description" name="description">
                </div>
                <a class="crearboton">
                    <button type="submit">Crear cuenta</button>
                </a>
            </div>
        </form>
    </main>
</body>
</html>