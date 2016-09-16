var ports = [91, 92, 93, 95, 96, 97];

var rgbCorrespondences = {
    95: 'salone',
    96: 'bagno',
    97: 'matrimoniale'
}
var stanza, str;
var r, g, b, w, wPercentage;
var hexdecimal, hex;

loadXMLcallback = function (port, portArray){
    if(parseInt(port) in rgbCorrespondences){
        stanza = rgbCorrespondences[parseInt(port)];
        // LED RGB
        if($("#rgb_" + stanza).length > 0){
            g = portArray['PWM1'] / 2;
            r = portArray['PWM2'] / 2;
            b = portArray['PWM4'] / 2;
            hexdecimal = pad(Number(r).toString(16), 2) + pad(Number(g).toString(16), 2) + pad(Number(b).toString(16), 2);
            hex = pad(r, 3) + pad(g, 3) + pad(b, 3);
            $("#rgb_" + stanza).spectrum("set", "#" + hexdecimal);
            $('#rgb_' + stanza).parent().find('.sp-preview-img').attr('src', 'shared/drawLamp.php?rgb=' + hex);
        }
        // LED WHITE
        if($("#white_" + stanza).length > 0){
            w = portArray['PWM3'] / 2;
            wPercentage = ((w * 100) / 250);
            $("#white_" + stanza).val(wPercentage);
            str = wPercentage + "%";
            if(wPercentage == 0){
                str = 'Accendi/Regola';
            }
            $("#white_" + stanza + "_span").html(str);
        }
    }else{
        setLedView(port, portArray, appicciaStuta);
    }
}

var tr, port, led, img;
function appicciaStuta (elem, isClick = false){
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
        setLed(port, led);
    }else{
        if(tr.attr("data-acceso") == 1){
            img.attr("src", lampadinaAccesa);
        }else if(tr.attr("data-acceso") == 0){
            img.attr("src", lampadinaSpenta);
        }
    }
}

$(document).ready(function(){
    reloadColor("ffffff", "salone");
    reloadColor("ffffff", "matrimoniale");
    reloadColor("ffffff", "bagno");
});