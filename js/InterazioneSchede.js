var assPorte= new Array();

/*
Carico lo status.xml appena la pagina e pronta
*/
$(document).ready(function(){
  //  loadListner();
    assPorte[91]=201;
    assPorte[92]=202;
    assPorte[93]=203;
    assPorte[94]=204;
    loadXMLStatus();
    /*
    quando clicco su un elemento avente l'attributo data-click settato invio una richiesta html per cambire il valore
    */

});
function loadListner(){
        $("body").on("click","div [data-click=true]",setLed);
}
function loadXMLStatus(){
    str = "<div>";
    $.ajax({
        dataType: "json",
        type: "get",
        url: "leggi.php?jsonDie=true"
    })
    .done(function(el){
        $.each(el, function(port, portArray){
            $.each(this, function(tagName, value) {
                type = tagName.substring(0, 3);
                number = tagName.substring(3);
                $("[data-port=" + port + "][data-" + type + "=" + number + "]").attr("data-acceso", value);
                $(".fatto tr").each(function(i, elem){
                    appicciaStuta(elem, true);
                });
                /*
                str = str + tagName + " = " + value + " -> ";
                if(tagName.substring(0, 3).localeCompare("btn")==0){
                  //  button(port, tagName, value);
                }else if(tagName.substring(0, 3).localeCompare("led")==0){
                    sep = tagName.split('d');
                    sep = sep[1];
                    str = str + "<input type='button' value='cambia' onClick='setLed(" + port + "," + sep +")'>";
                  //  led(port, tagName, value);
                }else if(tagName.substring(0, 8).localeCompare("Cntdebug")==0){
                  //  counterDebug(port, tagName.substring(8, tagName.length), value);
                }
                str = str + "<br>";
                */
            });
        });
        //str = str + "</div>";
        //console.log("asd");
        //$("#test").html(str);
        setTimeout(loadXMLStatus(),500);
    })
    .error(function(){
        console.log("Errore di connessione");
        setTimeout(loadXMLStatus(),500);
    });
}

/*

function button($port, $tag, $val){
    if($("#" + $port + "_" + $tag).length > 0) {
        if($("#" + $port + "_" + $tag).html().localeCompare($val)!=0){
            // alert("Cambiamento fatto");
            $html=$val;
            if($tag.localeCompare("btn1")==0    ||
               $tag.localeCompare("btn5")==0    ||
               $tag.localeCompare("btn9")==0    ||
               $tag.localeCompare("btn13")==0) {
                $val== "up" ? $html = "<div class=\"rosso\">Non presente</div>" : $html = "<div class=\"verde\">Presente</div>" ;
            }
            if($tag.localeCompare("btn2")==0    ||
               $tag.localeCompare("btn6")==0    ||
               $tag.localeCompare("btn10")==0    ||
               $tag.localeCompare("btn14")==0) {
                $val== "up" ? $html = "<div>Aperta</div>" : $html = "<div>Chiusa</div>" ;
            }
            if($tag.localeCompare("btn4")==0    ||
               $tag.localeCompare("btn8")==0    ||
               $tag.localeCompare("btn12")==0    ||
               $tag.localeCompare("btn16")==0) {
                $val== "up" ? $html = "<div class=\"verde\"></div>" : $html = "<div class=\"rosso\">Presente</div>" ;
            }
            $("#" + $port + "_" + $tag).html($html);    
        }
    }
}
function led($port, $tag, $val){
    if($("#" + $port + "_" + $tag).length > 0) {
        if($("#" + $port + "_" + $tag).html().localeCompare($val)!=0){
            number = $tag.substr(3,$tag.length);
            $html = $val;
            $html1 = $val;
            //ENERGIA
            if($tag.localeCompare("led1")==0    ||
               $tag.localeCompare("led5")==0    ||
               $tag.localeCompare("led9")==0    ||
               $tag.localeCompare("led13")==0)  {
                    $val == 1 ? $html = "<div class='verde'>Attivo</div>" : $html = "<div class='rosso'>inattivo</div>" ;
                    $val == 1 ? $html1 = "<img src='img/ElettricitaOn.png' />" : $html1 = "<img src='img/ElettricitaOff.png' />" ;
            }
            //CLIAM
            if($tag.localeCompare("led2")==0    ||
               $tag.localeCompare("led6")==0    ||
               $tag.localeCompare("led10")==0   ||
               $tag.localeCompare("led14")==0   ){
                    $val == 1 ? $html = "<div class='verde'>Attivo</div>" : $html = "<div class='rosso'>inattivo</div>" ;
                    $val == 1 ? $html1 = "<img src='img/ClimaOn.png' />" : $html1 = "<img src='img/ClimaOff.png' />" ;
            }
            //EMERGENZA CAMERA
            if($tag.localeCompare("led4")==0    ||
               $tag.localeCompare("led8")==0    ||
               $tag.localeCompare("led12")==0   ||
               $tag.localeCompare("led16")==0   ){
                    $val == 1 ? $html1 = "<img src='img/EmergenzaOn.png' />" : $html1 = "<img src='img/EmergenzaOff.png' />" ;
                
            }            
            //AUTIMOATICO MANUALE
            if($tag.localeCompare("led17")==0 ||
               $tag.localeCompare("led18")==0 ||
               $tag.localeCompare("led19")==0 ||
               $tag.localeCompare("led20")==0 
              ){
                    $val == 1 ? $html = "<div class='verde'>Automatico</div>" : $html = "<div class='rosso'>Manuale</div>" ; 
                    $val == 1 ? $html1 = "<img src='img/Automatico.png' />" : $html1 = "<img src='img/Manuale.png' />" ; 
               }
            
            $(".container #" + $port + "_" + $tag).html($html);
            $(".fontpopup #" + $port + "_" + $tag).html($html1);
            $("#" + $port + "_" + $tag).attr("data-value",$val);
            $("#" + $port + "_" + $tag).attr("data-number",number);
           // alert("Cambiamento fatto");
        }
    }
            controllaAllarmePiano($port, $tag, $val);
            controllaAllarmeStanza($port, $tag, $val);
}
function controllaAllarmeStanza($port, $tag, $val){
    if(($tag.localeCompare("led4")==0)||
        ($tag.localeCompare("led8")==0)||
        ($tag.localeCompare("led12")==0)||
        ($tag.localeCompare("led16")==0)){
        if($val==1){   
            if(!$("#S" + $port + "_" + $tag).hasClass("lampeggiante")){
                $("#S" + $port + "_" + $tag).addClass("lampeggiante");
            }
        }else{
             $("#S" + $port + "_" + $tag).removeClass("lampeggiante");
        }
    }
}
function setLed(event){
    dataValue=$(event.currentTarget).attr("data-number");
    port = $(event.currentTarget).attr("id").split("_");
    address = "/set.php?address=" + assPorte[port[0]] + "&port=" + port[0] + "&led=" + dataValue;
   // address = "http://192.168.1." + assPorte[port[0]] +":80" + port[0] + "/leds.cgi?led=" + dataValue;
    //address = "http://smart.hotelmarad.homepc.it:80" + port[0] + "/leds.cgi?led=" + dataValue;
    $.ajax({
        type:"get",
        url: address
    }).done(function(obj){
    }).error(function(){
    });
}

*/
function setLed(port,led){

    address = "/set.php?address=" + assPorte[port] + "&port=" + port + "&led=" + led;
   // address = "http://192.168.1." + assPorte[port[0]] +":80" + port[0] + "/leds.cgi?led=" + dataValue;
    //address = "http://smart.hotelmarad.homepc.it:80" + port[0] + "/leds.cgi?led=" + dataValue;
    $.ajax({
        type:"get",
        url: address
    }).done(function(obj){
    }).error(function(){
    });
}
