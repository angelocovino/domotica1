<?php
    // PAGE SEEKER
    @include('shared/utilities.php');
    $pagina = explode(".", basename($_SERVER['PHP_SELF']));
    $paginaVisualizzata = $pagina = $pagina[0];
    $i = array_search($pagina, array_values($menu));
    $key = array_keys($menu)[$i];
    $menuUtilizzato = 0;
    if($i === false){
        $i = array_search($pagina, array_values($perimetro));
        $key = array_keys($perimetro)[$i];
        $menuUtilizzato = 1;
        if($i === false){
            $i = array_search($pagina, array_values($others));
            $key = array_keys($others)[$i];
            $paginaVisualizzata = $othersNames[$i];
            $menuUtilizzato = 2;
        }
    }
    // IO CLASS
    @include("class/io.class.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <link rel="shortcut icon" type="image/png" href="immagini/favicon.png"/>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
        <link href="css/header.css" rel="stylesheet" />
<?php
    echo "<script src='js/shared.php?page=" . $pagina . "'></script>";
?>
    </head>
    <body>
		<div id="popupBackground">&nbsp;</div>
        <header id="topMenu">
<?php
    switch($menuUtilizzato){
        default:
        case 0:
?>
            <a href="index.php"><img class='icona home' src='immagini/cabin.svg'></a>
<?php
            break;
        case 1:
?>
            <a href="perimetro.php"><img class='icona home' src='immagini/fence.svg'></a>
<?php
            break;
    }
?>
            <table id="corrente"><tr><td>
                <img class='icona' src='immagini/<?php echo $key; ?>.svg' /></td><td><?php echo $paginaVisualizzata; ?>
            </td></tr></table>
        </header>