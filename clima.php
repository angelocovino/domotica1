<?php @include('shared/header.php'); ?>
<script>
    /*
    *op = codice operazione
    *scheda = ultime 2 cifre della scheda clima
    */
    function GestioneCaldo(op,scheda){
        str = "";
        if(op==0){//abilità automatico
            str="SogliaTemp.htm?ReleTemp=1";
        }
        if(op==1){//Abilità manuale
            str = "forms.htm?all=C";
        }
        if(op==2){//Cambia temperatura
            var temp = "sogliaCaldo";
            if(scheda = 93) temp = "sogliaFreddo";
            str = "SogliaTemp.htm?soglia=" + $("#" + temp).val();
        }
        if(op==3){//accendi
            str = "leds.cgi?led=8";
        }
          $.ajax({
                dataType: "json",
                type: "get",
                url: "http://domotica.smart.homepc.it:80" + scheda + "/" + str
            })
            .done(function(el){
          })
            .error(function(obj,str1){

            });
    }
</script>
<div id="caldo" style="border:solid #000 1px; background-color:#ff8e8e">
    <h1>Caldo</h1>
    <select id="sogliaCaldo">
        <?php
        for($i=12;$i<37;$i+=0.5){
            echo "<option value=\"{$i}\">{$i}</option>";
        }
        ?>
    </select><button id="MemCaldo"  onClick='GestioneCaldo(2,91)'>Cambia soglia</button><br />
    Stato<p id="stato"></p>
    Temperaturaa<p id="Temperatura"></p>
    Soglia<p id="Soglia"></p>
    Automatico<div onClick='GestioneCaldo(0,91)' style="width:40px;cursor:pointer;"><img src="" id="automatico" /></div>
    Manuale<div onClick='GestioneCaldo(1,91)' style="width:40px;cursor:pointer;"><img src="" id="manuale" /></div>
</div>

<div id="Freddo" style="border:solid #000 1px;margin-top:10px; background-color:#8ec8ff">
    <h1>Freddo</h1>
    <select id="sogliaFreddo">
        <?php
        for($i=12;$i<37;$i++){
            echo "<option value=\"{$i}\">{$i}</option>";
            echo "<option value=\"{$i}.5\">{$i}.5</option>";
        }
        ?>
    </select><button id="MemCaldo" onClick='GestioneCaldo(2,93)'>Cambia soglia</button><br />
    Stato<p id="stato"></p>
    Temperaturaa<p id="Temperatura"></p>
    Soglia<p id="Soglia"></p>
    Automatico<div style="width:40px;cursor:pointer;" onClick='GestioneCaldo(0,93)'><img src="" id="automatico" /></div>
    Manuale<div style="width:40px;cursor:pointer;" onClick='GestioneCaldo(1,93)'><img src="" id="manuale" />
</div>
   
<?php @include('shared/footer.php'); ?>