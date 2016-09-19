<?php include("include/header.php"); ?>

<?php include("include/dbmanagement.php");
    $db= new dbmanagment();
    $db->opendatabase();
    $db->createDB();

?>

<style>
    .bktest{
        width: 860px;
        height: 30px;
        border: 1px solid #000;
        margin: 10px;
        background: linear-gradient(to right, #ff0000,#ffff00,#00ff00,#00ffff,#0000ff,#ff00ff,#ff0000); 
        cursor: cell;
    }
</style>

<!--
<div class="bktest">

</div>
-->

<input type="text" value="" id="string">
<input type="text" id="color">
<input type="hidden" value="" name="tempColor" id="tmpclo">

<script>
    paletta = [<?php $db->printColor(); ?>];
    reloadColor("ffffff");

    function reloadColor(baseColor){
            $("#color").spectrum({
                preferredFormat: "hsl",
                color:"#" + baseColor,        //color.toRgbBase()showPalette: true,
                showPalette: false,
                showInput: false,
                chooseText: "Applica",
                cancelText:"Annulla",
                palette:paletta,

                change: function(color) {
                    //color.toRgbBase()
                    //$("#tmpclo").val(color.toHex());
                    var color1 = color.toHsl();
                    console.log(color1);
                    var str = color1['h'] + "_" + color1['s'] + "_" + color1['l'];
                    console.log(str);
                    $('.sp-preview-img').attr('src', 'rgbColor.php?color=' + str);
                    $("#tmpclo").val(color.toHsl());
                    str = color.toRed() + "" + color.toGreen() + "" + color.toBlue();
                    $("#string").val("leds.cgi?rgb=" + str);
              //      $("#string").val("leds.cgi?rgb=" + color.toRgbBase());
                }   
            });        
    }
    
    function test(){
        URL = "saveColor.php?color=" + $("#tmpclo").val();
        $.ajax({
            url:  URL,
            method:"GET",
        }).done(function() {
            $( this ).addClass( "done" );
            paletta.push($("#tmpclo").val());
            reloadColor($("#tmpclo").val());
        });
    }
</script>

<input type="button" onclick="test()" value='Salva colore in preferiti'>
<?php include("include/footer.php"); ?>