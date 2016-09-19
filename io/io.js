var ports, loadXMLcallback;

function loadXMLStatus(ports, callback){
    $.ajax({
        dataType: "json",
        type: "get",
        url: "io/leggi.php",
        data: {ports: ports}
    })
    .done(function(el){
        $.each(el, function(port, portArray){
            if((typeof callback !== "undefined") && ($.isFunction(callback))){
                callback(port, portArray);
            };
        })
    })
    .error(function(obj,ErrorStr){
        console.log("Errore di connessione " + ErrorStr);
    })
    .complete(function(xhr, textStatus){
        if(xhr.status == 200){
            setTimeout(loadXMLStatus(ports, callback), 100);
        }else{
            setTimeout(loadXMLStatus(ports, callback), 500);
        }
    });
}

function setLed(port, led, isRGB = false){
    address = "io/set.php?address=" + 0 + "&port=" + port + "&led=" + led;
    if(isRGB === true){
        address = "io/set.php?address=" + 0 + "&port=" + port + "&rgb=" + led;
    }
    //address = "/set.php?address=" + assPorte[port] + "&port=" + port + "&led=" + led;
    $.ajax({
        type:"get",
        url: address
    }).done(function(obj){
    }).error(function(){
    });
}

$(document).ready(function(){
    if(
        typeof ports !== "undefined" &&
        (typeof loadXMLcallback !== "undefined") && ($.isFunction(loadXMLcallback))
    ){
        loadXMLStatus(ports, loadXMLcallback);
    }else{
        console.log("ports/callback undefined");
    }
});