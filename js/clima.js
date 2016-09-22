var ports = [91, 93];

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

var str;
var climateOperations = ['automatic', 'manual', 'update'];
function climateManagement(operation, scheda){
    if(climateOperations.indexOf(operation) > -1){
        switch(operation){
            case 'automatic':
                str="SogliaTemp.htm?ReleTemp=1";
                break;
            case 'manual':
                str = "forms.htm?all=C";
                break;
            case 'update':
                str = "SogliaTemp.htm?soglia=" + $(".sogliaSelect").val();
                break;
        }
        $.ajax({
            dataType: "json",
            type: "get",
            url: "http://domotica.smart.homepc.it:80" + scheda + "/" + str
        })
        .done(function(el){})
        .error(function(obj,str1){});
    }
}