var ports = [91, 92];

loadXMLcallback = function (port, portArray){
    setLedView(port, portArray, appicciaStuta);
}

var tr, port, led, btn, img;
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
    if(isClick && led != undefined){
        turnoff = tr.attr('data-turnoff');
        // TURN OFF WHITE LED BUTTON
        if(typeof turnoff !== "undefined" && turnoff == 1){
            setLed(port, 0, "pwm3");
        }else{
            setLed(port, led);
        }
    }else{
        if(tr.attr("data-acceso") == 'up' || tr.attr("data-acceso") == 1){
            setImage(img, tempImageOn);
        }else if(tr.attr("data-acceso") == 'dn' || tr.attr("data-acceso") == 0){
            setImage(img, tempImageOff);
        }
    }
}
function setImage(imgElement, image){
    imgElement.attr("src", image);
}