<?php
/*
if(isset($_GET['ports'])){
    var_dump($_GET['ports']);
}
*/
    //$server = 'http://192.168.1';
    $server = 'http://domotica.smart.homepc.it';
    $basePort = '80';
    $page = 'status.xml';
    $arrayRichieste = array(
        201 => 91,
        202 => 92,
        203 => 93,
        204 => 94,
        205 => 95,
        206 => 96,
        207 => 97
    );
    $xml = new XMLReader();
    $response = array();
    foreach($arrayRichieste as $key => $porta){
        $response[$porta] = array();
        //if($xml->open($server . '.' . $key . ':' . $basePort . $porta . '/' . $page)){
        if($porta > 95 ){
            $response[$porta] = $response[95];
        }else{
            if($xml->open($server . ':' . $basePort . $porta . '/' . $page)){
                while($xml->read()){
                    switch($xml->nodeType){
                        case (XMLReader::ELEMENT):
                            $tagName = $xml->localName;
                            $xml->read();
                            if($xml->depth > 1 ){
                                $response[$porta][$tagName] = $xml->value;
                            }
                            break;
                    }
                }
            $xml->close();
            }
        }
    }
    die(json_encode($response));
?>