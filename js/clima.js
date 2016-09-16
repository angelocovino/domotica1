var ports = [91, 93];

var on = "immagini/switchOn.svg";
var off = "immagini/switchOff.svg";

var climateCorrespondences = {
    91 : "caldo",
    93 : "freddo"
}
var selectedClimate, stato;
loadXMLcallback = function (port, portArray){
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
    }
}