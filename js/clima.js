var ports = [91, 93];

var on = "immagini/switchOn.svg";
var off = "immagini/switchOff.svg";

var climateCorrespondences = {
    91 : "caldo",
    93 : "freddo"
}
var selectedClimate, stato;
loadXMLcallback = function (port, portArray){
/*
    $.each(portArray, function(tagName, value) {

        if(port == 91 && tagName == 'led8'){//Leggo se acceso caldo
            stato = "Spento";
            if(value == "1") stato = "Acceso";
            console.log(stato);
            $("#Caldo #stato").html(stato);
            console.log( $("#Caldo #stato"));
        }
        if(port == 93 && tagName == 'led8'){//Leggo se acceso freddo
            stato = "Spento";
            if(value == "1") stato = "Acceso";
            $("#Freddo #stato").html(stato);
            console.log( $("#Freddo #stato"));
        }                
        if(port == 91 && tagName == 'temp'){//Leggo temperatura sensore caldo
            $("#Caldo #Temperatura").html(value);
        }
        if(port == 93 && tagName == 'temp'){//Leggo temperatura sensore freddo
            $("#Freddo #Temperatura").html(value);
        }
        if(port == 91 && tagName == 'soglia'){//Leggo temperatura soglia
            $("#Caldo #Soglia").html(value);
        }
        if(port == 93 && tagName == 'soglia'){//Leggo temperatura soglia
            $("#Freddo #Soglia").html(value);
        }
        if(port == 91 && tagName == 'allC'){//Leggo manuale attivo caldo
            stato = off;
            if(value == "1")  stato = on;
            $("#Caldo #manuale").attr('src',stato);
        }
        if(port == 93 && tagName == 'allC'){//Leggo manuale attivo freddo
            stato = off;
            if(value == "1")  stato = on;
            $("#Freddo #manuale").attr('src',stato);
        }
        if(port == 91 && tagName == 'ReleTemp'){//Leggo automatico attivo caldo
            stato = off;
            if(value == "1")  stato = on;
            $("#Caldo #automatico").attr('src',stato);
        }
        if(port == 93 && tagName == 'ReleTemp'){//Leggo automatico attivo freddo
            stato = off;
            if(value == "1")  stato = on;
            $("#Freddo #automatico").attr('src',stato);
        }
    });*/
    if(parseInt(port) in climateCorrespondences){
        selectedClimate = climateCorrespondences[parseInt(port)];
        
        // READ ACCESO/SPENTO
        stato = "Spento";
        if(portArray["led8"] == "1"){ stato = "Acceso"; }
        $("#" + selectedClimate + " .stato").html(stato);
        
        // READ TEMPERATURE
        $("#" + selectedClimate + " .temperature").html(portArray["temp"]);
        
        // READ SOGLIA TEMPERATURA
        $("#" + selectedClimate + " .soglia").html(portArray["soglia"]);
        
        // READ MANUAL ACCESO/SPENTO
        stato = off;
        if(portArray["allC"] == "1"){ stato = on; }
        $("#" + selectedClimate + " .manuale").attr('src', stato);
        
        // READ AUTOMATIC ACCESO/SPENTO
        stato = off;
        if(portArray["ReleTemp"] == "1"){ stato = on; }
        $("#" + selectedClimate + " .automatico").attr('src', stato);
    }ì
}