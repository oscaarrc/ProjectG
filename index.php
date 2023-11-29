<?php
    require "./Database/databases.php";
    require "./verificator.php";
    redirect();
    // require "cerrar_sesion.php";
    $db = conectarBD();
    $errores=[];
    $imgbanner=$_GET['img_Banner']??NULL;
    $foto=$_GET['foto']??NULL;
    $rareza=$_GET['rareza']??null; 
    $posequipo=$_GET['id_team']??1;
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
        if($imgbanner==1){
            $_SESSION[$equipo][0]="IMG/img_banner/".$foto;
            if($rareza=='4'){
                $_SESSION[$equipo][4]=4;
            } else{
                $_SESSION[$equipo][4]=5;
            }
        } else if($imgbanner==2){
            $_SESSION[$equipo][1]="IMG/img_banner/".$foto;
            if($rareza=='4'){
                $_SESSION[$equipo][5]=4;
            } else{
                $_SESSION[$equipo][5]=5;
            }
        } else if($imgbanner==3){
            $_SESSION[$equipo][2]="IMG/img_banner/".$foto;
            if($rareza=='4'){
                $_SESSION[$equipo][6]=4;
            } else{
                $_SESSION[$equipo][6]=5;
            }
        } else if($imgbanner==4){
            $_SESSION[$equipo][3]="IMG/img_banner/".$foto;
            if($rareza=='4'){
                $_SESSION[$equipo][7]=4;
            } else{
                $_SESSION[$equipo][7]=5;
            }
        } else{
            $pos=0;
        }
    
    $nombre=$_SESSION['nombre'];
    $description=$_SESSION['desc'];
    $RA=$_SESSION['RA'];
    $NM=$_SESSION['NM'];
    $UID=$_SESSION['usuario'];
    $equipos=$_SESSION[$equipo]??NULL;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>ProjectG</title>
</head>
<body>
    <div class="background"></div>
    <header>
        <div class="Titulo">
            <img src="./IMG/logof.png" href="index.php">
        </div>
        <div class="uid_container">
            <label>UID:</label>
            <label class="uid"><?php echo $UID?></label>
            <a href="/cerrar-sesion.php" class="cerrar">Cerrar sesión</a>
        </div>
    </header>
    <section class="info">
        <div class="contenedor-info">
        <div class="foto">
            <img src="./img/placeholder.png" alt="">
        </div>
        <div class="informacion">
            <h3 class="NombreJugador"><?php echo $nombre;?></h3>
            <div class="nivel">
                <div class="RA">
                    <h4>RA:</h4>
                    <h4><?php echo $RA?></h4>
                </div>
                <div class="NM">
                    <h4>NM:</h4>
                    <H4><?php echo $NM?></H4>
                </div>
            </div>
            <h3><?php echo $description;?></h3>
        </div>
        </div>
    </section>
    <div class="icon-teams">
        <div class="container-teams">
            <a href="./index.php?id_team=1" class="team1 iconoteam icon-team1">
            <img src="./IMG/plus.png">
            </a>
            <a href="./index.php?id_team=2" class="team2 iconoteam icon-team2">
            <img src="./IMG/plus.png">
            </a>
            <a href="./index.php?id_team=3" class="team3 iconoteam icon-team3">
            <img src="./IMG/plus.png">
            </a>
            <a href="./index.php?id_team=4" class="team4 iconoteam icon-team4">
                <img src="./IMG/plus.png">
            </a>
        </div>
    </div>
    <main>

        <div class="containerpjs">
            <div class="cont">
                <div class="pj1 pj">
                    <a href="characters.php?character=1&id_team=<?php echo $posequipo?>" class="add">
                        <img src="<?php echo $_SESSION[$equipo][0]?>"  class="<?php if($_SESSION[$equipo][4]==4){ echo "gacha4";} else if($_SESSION[$equipo][4]==5){ echo "gacha5";} else{echo "plus";}?>">
                    </a>
                </div>
                <div class="pj2 pj">
                    <a href="characters.php?character=2&id_team=<?php  echo$posequipo?>" class="add">
                    <img src="<?php echo $_SESSION[$equipo][1]?>" alt="" class="<?php if($_SESSION[$equipo][5]==4){ echo "gacha4";} else if($_SESSION[$equipo][5]==5){ echo "gacha5";} else{echo "plus";}?>">
                    </a>
                </div>
                <div class="pj3 pj">
                    <a href="characters.php?character=3&id_team=<?php echo $posequipo?>" class="add">
                    <img src="<?php echo $_SESSION[$equipo][2]?>" alt="" class="<?php if($_SESSION[$equipo][6]==4){ echo "gacha4";} else if($_SESSION[$equipo][6]==5){ echo "gacha5";} else{echo "plus";}?>">
                    </a>
                </div>
                <div class="pj4 pj">
                    <a href="characters.php?character=4&id_team=<?php echo $posequipo?>" class="add">
                    <img src="<?php echo $_SESSION[$equipo][3]?>" alt="" class="<?php if($_SESSION[$equipo][7]==4){ echo "gacha4";} else if($_SESSION[$equipo][7]==5){ echo "gacha5";} else{echo "plus";}?>">
                    </a>
                </div>
            </div>
        </div>
        <form method="POST"  class="botones">
        <?php if($equipos[0]!="IMG/plus.png" && $equipos[1]!="IMG/plus.png" && $equipos[2]!="IMG/plus.png" && $equipos[3]!="IMG/plus.png"){?>
            <div class="Guardarequipo">
                <a href="./guardar.php?id_team=<?php echo $posequipo?>" type="submit">Guardar Equipo</a>
            </div>
            <div class="Borrarequipo">
                <a href="./borrar.php?id_team=<?php echo $posequipo?>" type="submit">Borrar Equipo</a>
            </div>
            <div class="Actualizarequipo">
                <a href="./actualizar.php?id_team=<?php echo $posequipo?>" type="submit">Actualizar Equipo</a>
            </div>
    <?php } ?>
        </form>

    </main>
    <script src="./js/fondorandom.js"></script>
</body>
</html>
