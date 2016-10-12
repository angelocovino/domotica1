var ports = [93];

loadXMLcallback = function (port, portArray){
    if(portArray['led13']=="1"){//antincendio
        $("#Anti img").attr("src","immagini/estintore-fuoco.svg");
        $("#Anti span").html("ai attivo");
    }else{
        $("#Anti img").attr("src","immagini/extinguisher.svg");
        $("#Anti span").html("ai disattivo");
    }  
    $("#Anti").attr("data-enabled", portArray['led13']);
    
    if(portArray['led14']=="1"){//metano
        $("#Gas img").attr("src","immagini/gas-on.svg");
        $("#Gas span").html("gas acceso");
    }else{
        $("#Gas img").attr("src","immagini/gas-off.svg");
        $("#Gas span").html("gas spento");
    }
    $("#Gas").attr("data-enabled", portArray['led14']);
    
    if(portArray['led15']=="1"){//acqua
        $("#Acqua img").attr("src","immagini/faucet.svg");
        $("#Acqua span").html("acqua aperta");
    }else{
        $("#Acqua img").attr("src","immagini/faucet-off.svg");
        $("#Acqua span").html("acqua chiusa");
    }
    $("#Acqua").attr("data-enabled", portArray['led15']);
}
