<?php
    include("../shared/utilitiesServer.php");
    
    $port = $_GET['port'];
    $page = "leds.cgi";
    if(isset($_GET['led'])){
        $value = $_GET['led'];
        $str = "led=";
    }elseif(isset($_GET['rgb'])){
        $value = $_GET['rgb'];
        $str = "rgb=";
    }elseif(isset($_GET['pwm3'])){
        $value = $_GET['pwm3'];
        $str = "pwm3=";
        $page = "index.htm";
    }elseif(isset($_GET['all'])){
        $page = "forms.htm";
        $str = "all=";
        $value = $_GET['all'];
        //forms.htm?all=T
    }elseif(isset($_GET['modalit'])){
        $page = "forms.htm";
        $str = "modalit=";
        $value = $_GET['modalit'];
        //forms.htm?all=T
    }elseif(isset($_GET['Mon'])){
        $page = "index0.htm";
        $str = "Mon" . $_GET['Mon'] ."=";
        $value = "1";
    }elseif(isset($_GET['soglia'])){
        $page = "SogliaTemp.htm";
        $str = "soglia=";
        $value = $_GET['soglia'];
    }elseif(isset($_GET['ReleTemp'])){
        $page = "SogliaTemp.htm";
        $str = "ReleTemp=";
        $value = $_GET['ReleTemp'];
    }

    $str .= $value;
    $final = $server . '.' . $correspondences[$port] . ":". $serverPort . $port . "/" . $page . "?" . $str;
    echo $final . "<br>";
    if($isDebug == true){
        $final = $serverDebug . ":" . $serverDebugPort . $port  . "/" . $page . "?" . $str;
    }
    $final = "http://domotica.smart.homepc.it:80" . $port . "/" . $page . "?" . $str;
    echo $final;
    $pippo = file_get_contents($final);