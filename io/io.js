var ports, loadXMLcallback;

function loadXMLStatus(ports, callback){
    if(ports.length > 0){
        $.ajax({
            dataType: "json",
            type: "get",
            url: "io/leggi.php",
            data: {ports: ports}
        })
        .done(function(el){
            $.each(el, function(port, portArray){
                if((typeof callback !== "undefined") && ($.isFunction(callback))){
                    if(portArray.length < 1){
                        console.log("port " + port + " is down");
                    }
                    callback(port, portArray);
                };
            })
        })
        .error(function(obj,ErrorStr){
            console.log("Errore di connessione " + ErrorStr);
        })
        .complete(function(xhr, textStatus){
            if(xhr.status == 200){
                setTimeout(loadXMLStatus(ports, callback), 1000);
            }else{
                setTimeout(loadXMLStatus(ports, callback), 500);
            }
        });
    }
}

function setLed(port, value, type){
    if (type === undefined) {
        type = "led";
    }
    var setTypes = [
        "led",
        "rgb",
        "pwm3",
        "all",
        "modalit",
        "Mon",
        "soglia",
        "ReleTemp"
    ];
    
    if(type == "rgb" && value == 0){
        value = "0000000";
    }
    if(setTypes.indexOf(type) > -1){
        address = "io/set.php?port=" + port + "&" + type + "=" + value;
        $.ajax({
            type:"get",
            url: address
        }).done(function(obj){
        }).error(function(){
        });
    }
}

$(document).ready(function(){
    if(
        (typeof ports !== "undefined") &&
        (typeof loadXMLcallback !== "undefined") && ($.isFunction(loadXMLcallback))
    ){
        loadXMLStatus(ports, loadXMLcallback);
    }else{
        console.log("ports/callback undefined");
    }
});