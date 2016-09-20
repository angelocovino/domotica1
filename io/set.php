<?php
    $port = $_GET['port'];
    $address = $_GET['address'];
    $page = "leds.cgi";
var_dump($_GET['modalit']);
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
    }elseif($_GET['all']){
        $page = "forms.htm";
        $str = "all=";
        $value = $_GET['all'];
        //forms.htm?all=T
    }elseif(isset($_GET['modalit'])){
        $page = "forms.htm";
        $str = "modalit=";
        $value = $_GET['modalit'];
        //forms.htm?all=T
    }



    $str .= $value;
    //$final = "http://192.168.1.{$address}:80{$port}/leds.cgi?led={$led}";
    $final = "http://domotica.smart.homepc.it:80" . $port . "/" . $page . "?" . $str;
    echo $final;
    $pippo = file_get_contents($final);