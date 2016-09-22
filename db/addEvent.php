<?php
    @include("db/dbmanagement.php");
 

    $ora =  $_POST['eventHour'];
    $minuti = $_POST['eventMinute'];
    $giorno = $_POST['eventDay'];
    $mese = $_POST['eventMonth'];
    $anno = $_POST['eventYear'];
    $comando = $_POST['eventCommand'];

    $db = new dbmanagment();
    $db->opendatabase();
    $db->createDB();
    echo $db->addEvents($ora, $minuti, $giorno, $mese, $anno, $comando );

    
        
?>