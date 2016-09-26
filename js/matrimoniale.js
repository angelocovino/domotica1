var ports = [92, 93, 94, 97];

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
            hexdecimal = pad(Number(r).toString(16), 2) + pad(Number(g).toString(16), 2) + pad(Number(b).toString(16), 2);
            hex = pad(r, 3) + pad(g, 3) + pad(b, 3);
            if(hexLast == false || (hexLast != hex)){
                $("#rgb_" + stanza).spectrum("set", "#" + hexdecimal);
                $('#rgb_' + stanza).parent().find('.sp-preview-img').attr('src', 'shared/drawLamp.php?rgb=' + hex);
            }
            hexLast = hex;
        }
        // LED WHITE
        if($("#white_" + stanza).length > 0){
            w = portArray['PWM3'] / 2;
            wPercentage = ((w * 100) / 250);
            $("#white_" + stanza).val(wPercentage);
            str = wPercentage + "%";
            if(wPercentage == 0){ str = 'Accendi/Regola'; }
            $("#white_" + stanza + "_span").html(str);
        }
    }else{
        setLedView(port, portArray, appicciaStuta);
    }
}

var tr, port, led, btn, img;
function appicciaStuta (elem, isClick = false){
    if(elem.target){
        tr = $(elem.currentTarget);
        isClick = elem.data.isClick;
    }else{
        tr = $(elem);
    }
    port = tr.attr('data-port');
    led = tr.attr('data-led');
    btn = tr.attr('data-btn');
    img = tr.find("img");
    imageOn = tr.attr("data-image-on");
    imageOff = tr.attr("data-image-off");
    tempImageOn = lampadinaAccesa;
    tempImageOff = lampadinaSpenta;
    if(imageOn != undefined && imageOff != undefined){
        tempImageOn = imageOn;
        tempImageOff = imageOff;
    }
    if(led != undefined){
        if(isClick){
            setLed(port, led);
        }else{
            if(tr.attr("data-acceso") == 'up' || tr.attr("data-acceso") == 1){
                setImage(img, tempImageOn);
            }if(tr.attr("data-acceso") == 'dwn' || tr.attr("data-acceso") == 0){
                setImage(img, tempImageOff);
            }
        }
    }else{
        if(tr.attr("data-acceso") == 'up' || tr.attr("data-acceso") == 1){
            setImage(img, tempImageOn);
        }if(tr.attr("data-acceso") == 'dwn' || tr.attr("data-acceso") == 0){
            setImage(img, tempImageOff);
        }
    }
}
function setImage(imgElement, image){
    imgElement.attr("src", image);
}


$(document).ready(function(){
    reloadColor("ffffff", "matrimoniale");

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