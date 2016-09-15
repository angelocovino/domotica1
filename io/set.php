<?php
    $port=$_GET['port'];
    $address = $_GET['address'];
    if(isset($_GET['led'])){
        $led = $_GET['led'];
        $str = "led=" . $led;
    }elseif(isset($_GET['rgb'])){
        $rgb = $_GET['rgb'];
        $str = "rgb=" . $rgb;
    }
    //$final = "http://192.168.1.{$address}:80{$port}/leds.cgi?led={$led}";
    $final = "http://domotica.smart.homepc.it:80" . $port . "/leds.cgi?" . $str;
    //var_dump($final);
    $pippo = file_get_contents($final);
    //var_dump($pippo);