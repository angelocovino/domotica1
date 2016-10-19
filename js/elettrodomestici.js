var ports = [91, 92, 93];

loadXMLcallback = function (port, portArray){
    setLedView(port, portArray, appicciaStuta);
}

var tr, port, led, img, turnoff;
function appicciaStuta (elem, isClick){
    if (isClick === undefined) {
        isClick = false;
    }
    if(elem.target){
        tr = $(elem.currentTarget);
        isClick = elem.data.isClick;
    }else{
        tr = $(elem);
    }
    port = tr.attr('data-port');
    led = tr.attr('data-led');
    img = tr.find("img");
    if(isClick){
        turnoff = tr.attr('data-turnoff');
        // TURN OFF WHITE LED BUTTON
        if(typeof turnoff !== "undefined" && turnoff == 1){
            setLed(port, 0, "pwm3");
        }else{
            setLed(port, led);
        }
    }else{
        if(tr.attr("data-acceso") == 1){
            img.attr("src", presaAccesa);
        }else if(tr.attr("data-acceso") == 0){
            img.attr("src", presaSpenta);
        }
    }
}

$(document).ready(function(){});