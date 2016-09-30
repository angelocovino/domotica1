<?php
    // PAGE SEEKER
    @include('shared/utilities.php');
    $pagina = explode(".", basename($_SERVER['PHP_SELF']));
    $paginaVisualizzata = $pagina = $pagina[0];
    $i = array_search($pagina, array_values($menu));
    $key = array_keys($menu);
    $key = $key[$i];
    $menuUtilizzato = 0;
    if($i === false){
        $i = array_search($pagina, array_values($perimetro));
        $key = array_keys($perimetro);
        $key = $key[$i];
        $menuUtilizzato = 1;
        if($i === false){
            $i = array_search($pagina, array_values($others));
            $key = array_keys($others);
            $key = $key[$i];
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
        <META NAME="author"         CONTENT="ESSECI.srls & GRASSO AUTOMATION s.r.l" />
        <META NAME="description"    CONTENT="Gestione domotica"/>
        <META NAME="robots"         CONTENT="none" />
        <META NAME="DC"             CONTENT=”ita” language SCHEME=”RFC1766″ />
        
        
        <link href="../immagini/favicon.png" rel="apple-touch-icon" />
        <link href="../immagini/favicon-32x32.png" rel="apple-touch-icon" sizes="32x32"/>
        <link href="../immagini/favicon-64x64.png" rel="apple-touch-icon" sizes="64x64"/>
        <link href="../immagini/favicon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
        <link href="../immagini/favicon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
        <link href="../immagini/favicon-152x152.png" rel="apple-touch-icon" sizes="152x152" />
        <link href="../immagini/favicon-180x180.png" rel="apple-touch-icon" sizes="180x180" />
        <link href="../immagini/favicon-192x192.png" rel="apple-touch-icon" sizes="192x192" />
        <link href="../immagini/favicon-128x128.png" rel="apple-touch-icon" sizes="128x128" />
        <link href="../immagini/favicon.png" rel="icon" />
        <link href="../immagini/favicon-32x32.png" rel="icon" sizes="32x32"/>
        <link href="../immagini/favicon-64x64.png" rel="icon" sizes="64x64"/>
        <link href="../immagini/favicon-76x76.png" rel="icon" sizes="76x76" />
        <link href="../immagini/favicon-120x120.png" rel="con" sizes="120x120" />
        <link href="../immagini/favicon-152x152.png" rel="icon" sizes="152x152" />
        <link href="../immagini/favicon-180x180.png" rel="icon" sizes="180x180" />
        <link href="../immagini/favicon-192x192.png" rel="icon" sizes="192x192" />
        <link href="../immagini/favicon-128x128.png" rel="icon" sizes="128x128" />
        
        
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <link rel="apple-touch-icon" href="/immagini/favicon.png">
        <link rel="apple-touch-icon-precomposed" href="/immagini/favicon.png">
        <link rel="shortcut icon" type="image/png" href="immagini/favicon.png"/>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
        <link href="css/header.css" rel="stylesheet" />
        <link href="css/index.css" rel="stylesheet" />
<?php
    echo "<script src='js/shared.php?page=" . $pagina . "'></script>";
?>
    </head>
    <body>
		<div id="popupBackground">&nbsp;</div>
<?php
            include("shared/leftMenu.php");
/*
?>
        
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
<?php
*/
?>
            <div id="indexContainer">