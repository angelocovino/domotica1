<?php
    @include("db/dbmanagement.php");

    $db = new dbmanagment();
    $db->opendatabase();
    $db->createDB();
    
    $tipo = $_POST['eventType'];

    // 0 = addEvento con data
    // 1 = addEventoGiornaliero
    // 2 = deleteEvent
    // 3 = DeleteEventGiornaliero
    // 4 = enableEventGiornaliero
    // 5 = DisabledEventGiornaliero

    if($tipo == 0){
        $ora = $_POST['eventHour'];
        $minuti = $_POST['eventMinute'];
        $giorno = $_POST['eventDay'];
        $mese = $_POST['eventMonth'];
        $anno = $_POST['eventYear'];
        $comando = $_POST['eventCommand'];
        $db->addEvents($ora, $minuti, $giorno, $mese, $anno, $comando);
    }

    if($tipo == 1){
        $ora = str_pad($_POST['eventHour'], 2 , "0", STR_PAD_LEFT);
        $minuti = str_pad($_POST['eventMinute'], 2 , "0", STR_PAD_LEFT);
        $giorni = $_POST['eventDays'];
        $giorni = implode(',', $giorni);
        $comando = $_POST['eventCommand'];        
        $db->addEventsScheduled($ora,$minuti,$giorni,$comando);
    }

    if($tipo == 2){
        $id =  $_POST['id'];
        $db->deleteEvents($id);
    }

    if($tipo == 3){
        $id =  $_POST['id'];
        $db->deleteEventsScheduled($id);
    }

    if($tipo == 4){
        $id =  $_POST['id'];
        $db->enableEventScheduled($id);
    }

    if($tipo == 5){
        $id =  $_POST['id'];
        $db->disableEventScheduled($id);
    }
    if($tipo == 0 || $tipo == 1){
        $old = $_SERVER['HTTP_REFERER'];
        header('Location: ' . $old);
    }
    echo (json_encode($tipo);
?>