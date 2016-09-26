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

if(isset($_GET['ports'])){
    foreach($_GET['ports'] as $port){
        if(array_key_exists($port, $correspondences)){
            $arrayRichieste[$correspondences[$port]] = $port;
        }
    }
}else{
    /*
    $arrayRichieste = array(
        201 => 91,
        202 => 92,
        203 => 93,
        204 => 94,
        205 => 95,
        206 => 96,
        207 => 97
    );
    */
    $arrayRichieste = array();
}
    //$server = 'http://192.168.1';
    $server = 'http://domotica.smart.homepc.it';
    $basePort = '80';
    $page = 'status.xml';
    $xml = new XMLReader();
    $response = array();
    if(isset($arrayRichieste)){
        foreach($arrayRichieste as $key => $porta){
            $response[$porta] = array();
            //if($xml->open($server . '.' . $key . ':' . $basePort . $porta . '/' . $page)){
            if($porta > 95){
                if(in_array(205, $arrayRichieste)){
                    $response[$porta] = $response[95];
                }
            }else{
                if(@$xml->open($server . ':' . $basePort . $porta . '/' . $page)){
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
    }
    die(json_encode($response));
?>