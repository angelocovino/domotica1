
<?php
    // PAGE SEEKER
    @include('shared/utilities.php');
    $pagina = explode(".", basename($_SERVER['PHP_SELF']));
    $pagina = $pagina[0];
    $i = array_search($pagina, array_values($menu));
    $key = array_keys($menu)[$i];
    // IO CLASS
    @include("class/io.class.php");
?>
<html>
    <head>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <script src="js/shared.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
        <link href="css/header.css" rel="stylesheet" />
<?php
    if(strcasecmp($pagina, "perimetro") == 0):
?>
        <link href="css/jquerySVG/jquery.svg.css" type="text/css">
        <script src="js/jquerySVG/jquery.svg.js"></script>
        <script src="js/jquerySVG/jquery.svgdom.js"></script>
        <script src="js/jquerySVG/jquery.svganim.js"></script>
<?php
    elseif(strcasecmp($pagina, "luci") == 0):
?>
        <link href="css/spectrum.css" rel="stylesheet" />
        <script src="js/spectrum.js"></script>
<?php
    endif;
?>
    </head>
    <body>
        <header id="topMenu">
            <a href="index.php"><img class='icona home' src='immagini/cabin.svg'></a>
            <table id="corrente"><tr><td><img class='icona' src='immagini/<?php echo $key; ?>.svg' /></td><td><?php echo $pagina; ?></td></tr></table>
        </header>