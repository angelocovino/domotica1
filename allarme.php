<?php @include('shared/header.php'); ?>
    <style>
        .button{
            width: 5%;
            margin: 1%;
            display: inline-block;
            text-align: center;
            background-color: lightgray;
            box-shadow: 0 0 1px 1px darkgray;
            padding: 10px;
            border-radius: 20px;
            cursor: pointer;
        }
        #Riciclo{
            display: inline-block;
            width: 20%;
            background-color: lightgray;
            box-shadow: 0 0 1px 1px darkgray;
            padding: 10px;
            border-radius: 20px;
        }
        .stato{
            width: 10%;
        }
        .cont{
            margin: 1%;
            text-align: center;
        }
        .riciclo{
            width: 48%;
            display: inline-block;
        }
        .riciclo img{
            width: 50%;
        }
        .elemList{
            background-color: #fff;
            border-radius: 20px;
            line-height: 26px;
            height: 30px;
            box-shadow: 0 0 1px 1px darkgray;
            cursor: pointer;
        }
        .sirena{
            cursor: pointer;
        }
        .reset{
            display: inline-block;
        }
    </style>

<div class="cont">
    <div class="stato">
        <img onclick="setLed(93,16)" class="sirena" src="immagini/sirengreen.svg" />
        Stato <span id="statoAllarme"></span>
        <progress style="display:none" id="loadBar" value="1" max="60"></progress>
    </div><br/>

    <div class="button" onclick="setLed('93','T','all')">
        <img src="immagini/shieldRed.svg" />
        <p>Allarme totale</p>
    </div>
    
    <div class="button" onclick="setLed('93','P','all')">
        <img src="immagini/sheldGren.svg"  />
        <p>Allarme parziale</p>
    </div>
    
    <div class="button reset" onclick="setLed('93','R','all')">
        <img src="immagini/warning%20(1).svg"  />
        <p>Reset allarme</p>
    </div><br />
    
     <div class="" id="Riciclo">
        <div class="riciclo">
            <img src="immagini/recycling.svg" />
            <p>Modalita riciclo</p>
         </div><div class="riciclo">
            <div class="lista">
                <div class="elemList attivo" onclick="setLed('93','2','modalit')">Attiva</div>
                <div class="elemList parziale" onclick="setLed('93','1','modalit')">Parziale</div>
                <div class="elemList disattivo" onclick="setLed('93','0','modalit')">Disattiva</div>             
             </div>
         </div>
         

    </div>   
</div>
<?php @include('shared/footer.php'); ?>