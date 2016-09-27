var ports = [91, 93];

var climateCorrespondences = {
    91 : "caldo",
    93 : "freddo"
}
var selectedClimate, stato, spentiEntrambi;
loadXMLcallback = function (port, portArray){
    
    if(parseInt(port) in climateCorrespondences){
        selectedClimate = climateCorrespondences[parseInt(port)];
        
        // READ ACCESO/SPENTO
        stato = "Spento";
        if(portArray["led8"] == "1"){ stato = "Acceso"; }
        $("#" + selectedClimate + " .stato").html(stato);
        
        // READ TEMPERATURE
        portArray["temp"] = portArray["temp"].replace("---", "-");
        $("#" + selectedClimate + " .temperature").html(portArray["temp"]);
        
        // READ SOGLIA TEMPERATURA
        $("#" + selectedClimate + " .soglia").html(portArray["soglia"]);
        
        spentiEntrambi = true;
        // READ MANUAL ACCESO/SPENTO
        stato = off;
        if(portArray["allC"] == "1"){ stato = on; }
        $("#" + selectedClimate + " .manuale").attr('src', stato);
        if(stato == on){
            spentiEntrambi = false;
            $("#" + selectedClimate + " .automaticManual").html("Manuale");
        }
        
        // READ AUTOMATIC ACCESO/SPENTO
        stato = off;
        if(portArray["ReleTemp"] == "1"){ stato = on; }
        $("#" + selectedClimate + " .automatico").attr('src', stato);
        if(stato == on){
            spentiEntrambi = false;
            $("#" + selectedClimate + " .automaticManual").html("Automatico");
        }
        
        if(spentiEntrambi == true){
            $("#" + selectedClimate + " .automaticManual").html("AUTOMATICO/MANUALE");
        }
    }
}

var str;
var climateOperations = ['automatic', 'manual', 'update'];
function climateManagement(clima, operation, scheda){
    if(climateOperations.indexOf(operation) > -1){
        switch(operation){
            case 'automatic':
                setLed(scheda, 1, "ReleTemp");
                break;
            case 'manual':
                setLed(scheda, "C", "all");
                break;
            case 'update':
                setLed(scheda, $("#" + clima + " .sogliaSelect").val(), "soglia");
                break;
        }
    }
}

$(document).ready(function(){
    $(".comparoScomparo").parent().click(function(e){
        if($(e.target).is('li') || $(e.target).is('span')){
            $(this).find(".comparoScomparo").fadeToggle(500);
        }
    });
    $(".comparoScomparo").parent().css('cursor', 'pointer');
});