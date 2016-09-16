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
        <header id="topMenu">
            <a href="index.php"><img class='icona home' src='immagini/cabin.svg'></a>
            <table id="corrente"><tr><td><img class='icona' src='immagini/<?php echo $key; ?>.svg' /></td><td><?php echo $pagina; ?></td></tr></table>
        </header>