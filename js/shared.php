<?php
    header("Content-type: text/javascript");
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
?>
function loadScript(url, callback){
    var script = document.createElement("script")
    script.type = "text/javascript";
    if (script.readyState) { //IE
        script.onreadystatechange = function () {
            if (script.readyState == "loaded" || script.readyState == "complete") {
                script.onreadystatechange = null;
                callback();
            }
        };
    } else { //Others
        script.onload = function () {
            callback();
        };
    }
    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);
}
function loadStyle(url){
    $("head").append("<link rel='stylesheet' href='" + url + "' type='text/css' />");
}
loadScript("js/jquery.min.js", function () {
    $(document).ready(function(){
        // TITOLO TOGGLE
        $(".titolo").click(function (){
            var fatti = $(this).parent().find(".fatti");
            if($(".stanza > .titolo img").is(":visible")){
                if($(fatti).is(":visible")){
                    $(fatti).hide(500);
                    $(this).find("img").removeClass('ruotami');
                }else{
                    $(fatti).show(500);
                    $(this).find("img").addClass('ruotami');
                }
            }else{
                $(this).show(0);
            }
        });

        // APPICCIA/STUTA ON CLICK
        if((typeof appicciaStuta !== "undefined") && ($.isFunction(appicciaStuta))){
            $("body").on("click",".fatto tr", {isClick: true}, appicciaStuta);
            $(".fatto tr").each(function(i, elem){
                appicciaStuta(elem);
            });
        }

        // CHECK RESPONSIVE ON WINDOW RESIZE
        if($(window).width() < 801){ below801 = true; }
        $(window).resize(function() {
            if(below801 && $(window).width()>800){
                below801 = false;
                $(".fatti").show(0);
            }else if(!below801 && $(window).width()<801){
                below801 = true;
                $(".fatti").hide(0);
                $(".titolo").find("img").removeClass('ruotami');
            }
        });
    });
    loadScript("io/io.js", function(){});
<?php
        if(isset($page)):
            echo "loadScript('js/" . $page . ".js', function () {});";
            if(strcasecmp($page, "perimetro") == 0):
?>
    loadStyle("css/jquerySVG/jquery.svg.css");
    loadScript("js/jquerySVG/jquery.svg.js", function(){});
    loadScript("js/jquerySVG/jquery.svgdom.js", function(){});
    loadScript("js/jquerySVG/jquery.svganim.js", function(){});
<?php
            elseif(strcasecmp($page, "luci") == 0):
?>
    loadStyle("css/spectrum.css");
    loadScript("js/spectrum.js", function(){});
<?php
            endif;
        endif;
    ?>
});

var lampadinaAccesa = "immagini/lamp-2.svg";
var lampadinaSpenta = "immagini/lamp-3.svg";
var below801 = false;

function pad (str, max) {
    str = str.toString();
    return ((str.length < max) ? pad("0" + str, max) : str);
}

function reloadColor(baseColor, stanza){
    $("#rgb_" + stanza).spectrum({
        preferredFormat: "hsl",
        color:"#" + baseColor,
        showPalette: false,
        showInput: false,
        chooseText: "Applica",
        cancelText:"Annulla",
        change: function(color) {
            var color1 = color.toHsl();
            var str = color1['h'] + "_" + color1['s'] + "_" + color1['l'];
            $('#rgb_' + stanza).parent().find('.sp-preview-img').attr('src', 'shared/drawLamp.php?color=' + str);
            str = pad(color.toRed(), 3) + "" + pad(color.toGreen(), 3) + "" + color.toBlue();
            console.log($('#rgb_' + stanza).parents("tr").attr("data-port"));
            setLed(95, str, "rgb");
            // RICORDATI DI METTERE TUTTI I LED
        }
    });
}

var type, number;
function setLedView(port, portArray, callback){
    $.each(portArray, function(tagName, value) {
        type = tagName.substring(0, 3);
        number = tagName.substring(3);
        $("[data-port=" + port + "][data-" + type + "=" + number + "]").attr("data-acceso", value);
        $(".fatto tr").each(function(i, elem){
            callback(elem);
        });
    });
}