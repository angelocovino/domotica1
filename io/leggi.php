<?php
    include("../shared/utilitiesServer.php");
    $correspondences = array(
            91 => 201,
            92 => 202,
            93 => 203,
            94 => 204,
            95 => 205,
            96 => 206,
            97 => 207
    );

    $arrayRichieste = array();
    if(isset($_GET['ports'])){
        foreach($_GET['ports'] as $port){
            if(array_key_exists($port, $correspondences)){
                $arrayRichieste[$correspondences[$port]] = $port;
            }
        }
    }
    $xml = new XMLReader();
    $response = array();
    if(isset($arrayRichieste)){
        foreach($arrayRichieste as $key => $porta){
            $response[$porta] = array();
            if($porta > 95){
                if(in_array(205, $arrayRichieste)){
                    $response[$porta] = $response[95];
                }
            }else{
                $xmlOpenString = $server . '.' . $key . ':' . $serverPort . $porta . '/' . $serverPage;
                if($isDebug == true){
                    $xmlOpenString = $server . ':' . $serverPort . $porta . '/' . $serverPage;
                }
                if(@$xml->open($xmlOpenString)){
                    while($xml->read()){
                        switch($xml->nodeType){
                            case (XMLReader::ELEMENT):
                                $tagName = $xml->localName;
                                $xml->read();
                                if($xml->depth > 1){
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