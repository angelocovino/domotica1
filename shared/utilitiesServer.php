<?php
    $server = array(
        "server" => 'http://192.168.1',
        "serverPort" => '80',
        "serverPage" => 'status.xml',
        "isDebug" => false,
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