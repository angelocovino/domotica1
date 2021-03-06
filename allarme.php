<?php @include('shared/header.php'); ?>
<table class='centeredContainer'>
    <tr>
        <td>
<?php
    include("shared/utilitiesServer.php");
    
    $xml = new XMLReader();
    $port = 93;
    $found = false;
    $password = "config_PasswordWeb";
    $xmlOpenStringBase = $server . '.' . $correspondences[$port] . ':' . $serverPort . $port;
    $xmlOpenString = $xmlOpenStringBase . '/' . $serverPage;
    if($isDebug == true){
        $xmlOpenStringBase = $serverDebug . ':' . $serverDebugPort . $port;
        $xmlOpenString = $xmlOpenStringBase . '/' . $serverDebugPage;
    }
    if(@$xml->open($xmlOpenString)){
        while($xml->read() && !$found){
            switch($xml->nodeType){
                case (XMLReader::ELEMENT):
                    $tagName = $xml->localName;
                    $xml->read();
                    if(strcasecmp($tagName, $password) == 0){
                        $password = $xml->value;
                        $found = true;
                    }
                    break;
            }
        }
        $xml->close();
    }
    
    $request = @file_get_contents($xmlOpenStringBase . "/forms.htm?Push");
    if($request === false):
?>
        <h3>Errore scheda <?php echo $port; ?>, contattare un tecnico!</h3>
<?php
    else:
        if(isset($_POST['pass']) && $_POST['pass'] == $password):
?>
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
                                echo "<td id='en{$i}'>";
                                if($i<16) echo "<button onclick=\"setLed('93','{$i}','Mon')\">Disabilita</button>";
                                echo "</td>";    
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <br />
                    <button onclick="popupClose()">Chiudi</button>
                </div>

                <div class="cont">
                    <div class="stato">
                        <img onclick="setLed(93,16)" class="sirena" src="immagini/sirengreen.svg" />
                        <span id="statoAllarme">Pronto</span>
                        <progress style="display:none" id="loadBar" value="1" max="60"></progress>
                    </div><br/>
                    <div class="button" onclick="setLed('93','T','all')">
                        <img src="immagini/shieldRed.svg" />
                        Allarme totale
                    </div>

                    <div class="button" onclick="setLed('93','P','all')">
                        <img src="immagini/sheldGren.svg"  />
                        Allarme parziale
                    </div>

                    <div class="button reset" onclick="setLed('93','R','all')">
                        <img src="immagini/warning%20(1).svg"  />
                        Reset allarme
                    </div><br />

                     <div id="Riciclo">
                        <div class="riciclo">
                            <img src="immagini/recycling.svg" /><br />
                            Modalita'<br />riciclo
                         </div><div class="riciclo">
                            <div class="lista">
                                <div class="elemList attivo" onclick="setLed('93','2','modalit')">Attiva</div>
                                <div class="elemList parziale" onclick="setLed('93','1','modalit')">Parziale</div>
                                <div class="elemList disattivo" onclick="setLed('93','0','modalit')">Disattiva</div>             
                             </div>
                         </div>
                    </div><br>
                    <a href="http://smarthome2.altervista.org/email_log_VarricchioArturo06.txt" class='testoResponsive'>Registro</a>
                    <button class='testoResponsive' onclick="popupOpen()">stato</button>
                </div>
            <?php else: ?>
                    <?php if(isset($_POST['pass'])): ?>
                        <h3>Password errata!</h3>
                    <?php else: ?>
                        <h3>Pagina protetta da Password</h3>
                    <?php endif; ?>
                        <div id="pwdZone">
                            <form method="post">
                                <input type="password" name="pass" placeholder='Password' /><br />
                                <input type="submit" name="Entra" value="Entra" />
                            </form>
                        </div>
            <?php endif; ?>
<?php
        endif;
?>
        </td>
    </tr>
</table>
<?php @include('shared/footer.php'); ?>