var ports = [93, 94];

loadXMLcallback = function (port, portArray){
    setLedView(port, portArray, appicciaStuta);
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
    if(led != undefined){
        if(isClick){
            setLed(port, led);
        }else{
            if(tr.attr("data-acceso") == 'up'){
                img.attr("src", tapparellaAbbassata);
            }if(tr.attr("data-acceso") == 'dwn'){
                img.attr("src", tapparellaAlzata);
            }
        }
    }else{
        if(tr.attr("data-acceso") == 'up'){
            img.attr("src", tapparellaAbbassata);
        }if(tr.attr("data-acceso") == 'dwn'){
            img.attr("src", tapparellaAlzata);
        }
    }
}