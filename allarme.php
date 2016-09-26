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
        
#calendarEventPopup {
    position: fixed;
    z-index: 100;
    top: calc(50% - 150px);
    left: calc(50% - 200px);
    width: 400px;
    padding: 10px;
    background-color: white;
    border: 0px solid black;
    display: none;
    border-radius: 20px;
    -webkit-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
    -o-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
}
calendarEvents table{
    width: 100%;
}
#calendarEvents table td{
    padding: 5px 10px;
    font-size: 1.1em;
}
#calendarEvents table td:not(.noBorder){
    border-bottom: 1px solid gray;
}
#calendarEvents table td:not(.noBorder):first-child{
    border-right: 1px solid gray;
    width: 25%;
    text-align: center;
}
#calendarEvents table tr.scheduledEvent {
    background: lightgray;
}
#calendarEvents .eventAddTime{
    width: 100%;
    text-align: left;
    border: 1px solid lightgray;
    border-radius: 5px;
}
    </style>

<?php 
    $sensori = array(
        1 => "Porta blindata",
        2 => "Finestra cucina",
        3 => "Finestra giorno",
        4 => "Finestra salotto",
        5 => "Finestra camera Andrea",
        6 => "Finestra camera Elisa",
        7 => "Serranda camera matrimoniale",
        9 => "Serranda camera Tony",
        10 => "Serranda bagnio di servizio",
        11 => "Serranda bagnio ospiti",
        16 => "Rilevamento incendio",
        17 => "Rete elettrica"
    )
?>

<div id="calendarEventPopup">
    <table>
        <tr>
            <th>Sensore</th>
            <th>Stato</th>
            <th>Contatore</th>
            <th>Abilita/disabilita</th>
        </tr>
        <?php
            foreach($sensori as $i => $key){
                echo "<tr>";
                echo "<td>{$key}</td>";    
                echo "<td id='stato{$i}'></td>";    
                echo "<td id='cnt{$i}'></td>";    
                echo "<td id='en{$i}'><button onclick=\"setLed('93','{$i}','Mon')\"></button></td>";    
                echo "</tr>";
            }
        ?>
    </table>
    <button onclick="popupClose()">stato</button>
</div>

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
         
    <button onclick="popupOpen()">stato</button>

    </div>   
</div>
<?php @include('shared/footer.php'); ?>