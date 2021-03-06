var ports = [91, 92, 93, 95, 96, 97];

var rgbCorrespondences = {
    95: 'salone',
    96: 'bagno',
    97: 'matrimoniale'
}
var stanza, str;
var r, g, b, w, wPercentage;
var hexdecimal, hex;
var hexLast = false;

loadXMLcallback = function (port, portArray){
    if(parseInt(port) in rgbCorrespondences){
        stanza = rgbCorrespondences[parseInt(port)];
        // LED RGB
        if($("#rgb_" + stanza).length > 0){
            g = portArray['PWM1'] / 2;
            r = portArray['PWM2'] / 2;
            b = portArray['PWM4'] / 2;
            if(g == 0 && r == 0 && b == 0){
                $("#rgb_" + stanza).spectrum("set", "#000000");
                $('#rgb_' + stanza).parent().find('.sp-preview-img').attr('src', 'immagini/lamp-3.svg');
            }else{
                hexdecimal = pad(Number(r).toString(16), 2) + pad(Number(g).toString(16), 2) + pad(Number(b).toString(16), 2);
                if(isNaN(r) || isNaN(g) || isNaN(b)){
                    $('#rgb_' + stanza).parent().find('.sp-preview-img').attr('src', 'immagini/lamp-3.svg');
                    hexLast = false;
                }else{
                    hex = pad(r, 3) + pad(g, 3) + pad(b, 3);
                    if(hexLast == false || (hexLast != hex)){
                        //$("#rgb_" + stanza).spectrum("set", "#" + hexdecimal);
                        $('#rgb_' + stanza).parent().find('.sp-preview-img').attr('src', 'shared/drawLamp.php?rgb=' + hex);
                    }
                    hexLast = hex;
                }
            }
        }
        // LED WHITE
        if($("#white_" + stanza).length > 0){
            w = portArray['PWM3'] / 2;
            wPercentage = ((w * 100) / 250);
            if(isNaN(wPercentage)){
                str = "-";
            }else{
                $("#white_" + stanza).val(wPercentage);
                str = wPercentage + "%";
            }
            if(wPercentage == 0){ str = 'Accendi/Regola'; }
            $("#white_" + stanza + "_span").html(str);
        }
    }else{
        setLedView(port, portArray, appicciaStuta);
    }
}

var tr, port, led, img, turnoff, turnoffrgb, ampere;
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
        turnoffrgb =  tr.attr('data-turnoff-rgb');
        // TURN OFF WHITE LED BUTTON
        if(typeof turnoff !== "undefined" && turnoff == 1){
            setLed(port, 0, "pwm3");
        }else if(typeof turnoffrgb !== "undefined" && turnoffrgb == 1){
            setLed(port, 0, "rgb");
        }else{
            setLed(port, led);
        }
    }else{
        if(tr.attr("data-acceso") == 'up' || tr.attr("data-acceso") == 1){
            img.attr("src", lampadinaAccesa);
        }else if(tr.attr("data-acceso") == 'dn' || tr.attr("data-acceso") == 0){
            img.attr("src", lampadinaSpenta);
        }
    }
}

$(document).ready(function(){
    reloadColor("ffffff", "salone");
    reloadColor("ffffff", "matrimoniale");
    reloadColor("ffffff", "bagno");

    // INPUT TYPE RANGE
    var calculatedHeight = $("input[type=range]").closest(".fatto").prev().find("td").height();
    $("input[type=range]").parent().css({
        "vertical-align" : "middle",
        "height" : (calculatedHeight+5) + "px",
        "padding" : "5px 0 0 0"
    });

    $("input[type=range]").change(function(){
        var port = $(this).parents("tr").attr('data-port');
        var ampere = ($(this).val() * 500) / 100;
        console.log(ampere);
        setLed(port, ampere, "pwm3");
    });

    $(document).on('input', '[type=range]', function(){
        var id = $(this).attr("id");
        $("#" + id + "_span").html($(this).val() + "%");
    });
});