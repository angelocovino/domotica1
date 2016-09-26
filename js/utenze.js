var ports = [93];

loadXMLcallback = function (port, portArray){
    if(portArray['led13']=="0"){//antincendio
        $("#Anti img").attr("src","immagini/extinguisher.svg");
    }else{
        $("#Anti img").attr("src","immagini/estintore-fuoco.svg");
    }  
    if(portArray['led14']=="0"){//metano
        $("#Gas img").attr("src","immagini/gas-off.svg");
    }else{
        $("#Gas img").attr("src","immagini/gas-on.svg");
    }
    if(portArray['led15']=="0"){//acqua
        $("#Acqua img").attr("src","immagini/faucet-off.svg");
    }else{
        $("#Acqua img").attr("src","immagini/faucet.svg");
    }
}
