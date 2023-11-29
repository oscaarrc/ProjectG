<?php
//Inicializar variables y constantes
require "./Database/databases.php";
require "./verificator.php";
redirect();


$db = conectarBD();
$UID=$_SESSION['usuario'];
$arma=$_GET["weapon"] ?? NULL;
$elemento=$_GET["element"] ?? NULL;
$rareza=$_GET["rareza"] ?? null;
$pj1=$_GET["character"] ?? NULL;
$posEquipo=$_GET['id_team']??NULL;



$queryarma= "SELECT img, img_Banner, name, element, weapon, rareza FROM characters WHERE weapon='${arma}';";
$queryelemento = "SELECT img, img_Banner, name, element, weapon, rareza FROM characters WHERE element='${elemento}';";
$queryrareza = "SELECT img, img_Banner, name, element, weapon, rareza FROM characters WHERE rareza='${rareza}';";
$querySel = "SELECT img, img_Banner, name, element, weapon, rareza FROM characters;";

if(!isset($_SESSION['personaje1'])){
    $personaje1='';
}else{
    $personaje1=$_SESSION['personaje1'];
}

if($elemento){
    $result = mysqli_query($db, $queryelemento);
}
elseif($rareza){
    $result = mysqli_query($db, $queryrareza);
}elseif($arma){
    $result = mysqli_query($db, $queryarma);
} else{
    $result = mysqli_query($db, $querySel);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/index.css">
    <title>ProjectG</title>
</head>
<body>
    <div class="background"></div>
    <header>
        <div class="Titulo">
            <a href="index.php"><img src="./IMG/logof.png"></a>
        </div>
        <div class="uid_container">
            <label>UID:</label>
            <label class="uid"><?php echo $UID ?></label>
            <a href="/cerrar-sesion.php" class="cerrar">Cerrar sesión</a>
        </div>
    </header>
    <section class="filtros">
        <div class="menu">
            <div class="elementos">
                <a href="./characters.php?element=Pyro&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>"class="pyro elemento"><img src="./IMG/elementos/pyro.png" alt="pyro"></a>
                <a href="./characters.php?element=Hydro&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>"class="hydro elemento" ><img src="./IMG/elementos/hydro.png" alt="hydro"></a>
                <a href="./characters.php?element=Cryo&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>"class="cryo elemento"><img src="./IMG/elementos/cryo.png" alt="cryo"></a>
                <a href="./characters.php?element=Electro&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>"class="electro elemento"><img src="./IMG/elementos/electro.png" alt="electro"></a>
                <a href="./characters.php?element=Anemo&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>"class="anemo elemento"><img src="./IMG/elementos/anemo.png" alt="anemo"></a>
                <a href="./characters.php?element=Geo&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>"class="geo elemento"><img src="./IMG/elementos/geo.png" alt="geo"></a>
                <a href="./characters.php?element=Dendro&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>"class="dendro elemento"><img src="./IMG/elementos/dendro.png" alt="dendro"></a>
            </div>
            <div class="rarezas">
                <a href="./characters.php?rareza=4&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>" class="4 rareza">4<img src="./IMG/estrella.png"></a>
                <a href="./characters.php?rareza=5&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>" class="5 rareza">5 <img src="./IMG/estrella.png"></a>
            </div>
            <div class="armas">
                <a href="./characters.php?weapon=espada ligera&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>" class="espada_ligera arma"><img src="./IMG/armas/espada_ligera.png" alt="espada_ligera"></a>
                <a href="./characters.php?weapon=mandoble&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>" class="mandoble arma"><img src="./IMG/armas/mandoble.png" alt="mandoble"></a>
                <a href="./characters.php?weapon=arco&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>" class="arco arma"><img src="./IMG/armas/arco.png" alt="arco"></a>
                <a href="./characters.php?weapon=catalizador&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>" class="catalizador arma"><img src="./IMG/armas/catalizador.png" alt="catalizador"></a>
                <a href="./characters.php?weapon=lanza&character=<?php echo $pj1;?>&id_team=<?php echo $posEquipo?>" class="lanza arma"><img src="./IMG/armas/lanza.png" alt="lanza"></a>  
            </div>
                <a href="./characters.php" class="eliminar"><img src="./IMG/x.png"></a>
        </div>
    </section>
    <main class="contenidos">
        <div class="contenedor-pjs">
            <?php 
        while ($row=mysqli_fetch_assoc($result)){ $rare=$row['rareza'];?> 
    <?php   if($rare=="4"){
                if(intval($pj1)==1){
                ?>
                    <a href="./index.php?img_Banner=1&foto=<?php echo $row['img_Banner']?>&rareza=<?php echo $rare ?>&id_team=<?php echo $posEquipo?>" class="personaje personaje4">
                <?php 
                }elseif(intval($pj1)==2){
                ?>
                    <a href="./index.php?img_Banner=2&foto=<?php echo $row['img_Banner']?>&rareza=<?php echo $rare ?>&id_team=<?php echo $posEquipo?>" class="personaje personaje4">
                <?php 
                }elseif(intval($pj1)==3){
                    ?>
                        <a href="./index.php?img_Banner=3&foto=<?php echo $row['img_Banner']?>&rareza=<?php echo $rare ?>&id_team=<?php echo $posEquipo?>" class="personaje personaje4">
                    <?php 
                }elseif(intval($pj1)==4){ 
                    ?>
                        <a href="./index.php?img_Banner=4&foto=<?php echo $row['img_Banner']?>&rareza=<?php echo $rare ?>&id_team=<?php echo $posEquipo?>" class="personaje personaje4">
                    <?php 
                    }
                ?>    
                <?php 
                } 
            else{ 
                if(intval($pj1)==1){
                ?>
                    <a href="./index.php?img_Banner=1&foto=<?php echo $row['img_Banner']?>&rareza=<?php echo $rare ?>&id_team=<?php echo $posEquipo?>" class="personaje personaje5">
                <?php 
                }elseif(intval($pj1)==2){
                ?>
                    <a href="./index.php?img_Banner=2&foto=<?php echo $row['img_Banner']?>&rareza=<?php echo $rare ?>&id_team=<?php echo $posEquipo?>" class="personaje personaje5">
                <?php 
                }elseif(intval($pj1)==3){
                    ?>
                        <a href="./index.php?img_Banner=3&foto=<?php echo $row['img_Banner']?>&rareza=<?php echo $rare ?>&id_team=<?php echo $posEquipo?>" class="personaje personaje5">
                    <?php 
                }elseif(intval($pj1)==4){
                    ?>
                        <a href="./index.php?img_Banner=4&foto=<?php echo $row['img_Banner']?>&rareza=<?php echo $rare ?>&id_team=<?php echo $posEquipo?>" class="personaje personaje5">
                    <?php 
                    }
                } ?>       
                <picture>
                    <source srcset="./IMG/img_icon/<?php echo $row['img']?>" type="image/png">
                    <img loading="lazy" src="./IMG/img_icon<?php echo $row['img']?>" alt="" >
                </picture>
                <div class="contenido-pj">
                    <h3><?php echo $row['name']?></h3>
                    <div class="element">
                        <p class="element"><?php echo $row['element']?></p>
                    </div>
                    <div class="weapon">
                        <p class="weapon"><?php echo $row['weapon']?></p>
                    </div>
                </div>
            </a>
        <?php } ?>
        </div>
    </main>
</body>
<script src="./js/fondorandom.js"></script>
</html>    

