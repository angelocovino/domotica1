function loadScript(url, callback) {
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

        // INPUT TYPE RANGE
        var calculatedHeight = $("input[type=range]").closest(".fatto").prev().find("td").height();
        $("input[type=range]").parent().css({
            "vertical-align" : "middle",
            "height" : (calculatedHeight+5) + "px",
            "padding" : "5px 0 0 0"
        });

        $(document).on('input', '[type=range]', function(){
            var id = $(this).attr("id");
            $("#" + id + "_span").html($(this).val() + "%");
        });
    });
});
loadScript("io/io.js", function () {});

var lampadinaAccesa = "immagini/lamp-2.svg";
var lampadinaSpenta = "immagini/lamp-3.svg";
var below801 = false;

function pad (str, max) {
    str = str.toString();
    return ((str.length < max) ? pad("0" + str, max) : str);
}
function reloadColor(baseColor, stanza){
    salone = $("#rgb_" + stanza).spectrum({
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
            setLed(95, str, true);
        }
    });
}