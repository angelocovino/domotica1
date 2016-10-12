<?php
    $correspondences = array(
            91 => 201,
            92 => 202,
            93 => 203,
            94 => 204,
            95 => 205,
            96 => 206,
            97 => 207
    );
    $server = array(
        "server" => 'http://192.168.1',
        "serverPort" => '80',
        "serverPage" => 'status.xml',
        "isDebug" => true,
        "serverDebug" => 'http://domotica.smart.homepc.it',
        "serverDebugPort" => '80',
        "serverDebugPage" => 'status.xml'
    );
    if(isset($_GET['js']) && $_GET['js']==true){
        foreach($server as $var => $value){
            echo "var {$var}='{$value}';";
        }
    }
    extract($server);
?>