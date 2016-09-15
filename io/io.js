var stanza;
function loadXMLStatus(ports){
    //console.log(ports);
    $.ajax({
        dataType: "json",
        type: "get",
        url: "io/leggi.php"//,
        //data: {ports: ports}
    })
    .done(function(el){
        $.each(el, function(port, portArray){
            if(port > 94){
                switch(parseInt(port)){
                    case 95:
                        stanza = "salone";
                        break;
                    case 96:
                        stanza = "bagno";
                        break;
                    case 97:
                        stanza = "matrimoniale";
                        break;
                }
                if($("#rgb_" + stanza).length > 0){
                    // LED RGB
                    var g = portArray['PWM1'] / 2;
                    var r = portArray['PWM2'] / 2;
                    var b = portArray['PWM4'] / 2;
                    var hexdecimal = pad(Number(r).toString(16), 2) + pad(Number(g).toString(16), 2) + pad(Number(b).toString(16), 2);
                    var hex = pad(r, 3) + pad(g, 3) + pad(b, 3);
                    $("#rgb_" + stanza).spectrum("set", "#" + hexdecimal);
                    $('#rgb_' + stanza).parent().find('.sp-preview-img').attr('src', 'shared/drawLamp.php?rgb=' + hex);
                    // LED WHITE
                    var w = portArray['PWM3'] / 2;
                    var wPercentage = ((w * 100) / 250);
                    $("#white_" + stanza).val(wPercentage);
                    var str = wPercentage + "%";
                    if(wPercentage == 0){
                        str = 'Accendi/Regola';
                    }
                    $("#white_" + stanza + "_span").html(str);
                }
            }else{
                $.each(this, function(tagName, value) {
                    type = tagName.substring(0, 3);
                    number = tagName.substring(3);
                    $("[data-port=" + port + "][data-" + type + "=" + number + "]").attr("data-acceso", value);
                    $(".fatto tr").each(function(i, elem){
                        appicciaStuta(elem);
                    });
                });
            }
        });
        setTimeout(loadXMLStatus(),100);
    })
    .error(function(){
        console.log("Errore di connessione");
        setTimeout(loadXMLStatus(),500);
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
    loadXMLStatus();
});