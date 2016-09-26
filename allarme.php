<?php @include('shared/header.php'); ?>
<table class='centeredContainer'>
    <tr>
        <td>
<?php if(isset($_POST['pass']) && md5($_POST['pass']) == md5("1234545")):?>
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
                            if($i<16) echo "<button onclick=\"setLed('93','{$i}','Mon')\"></button>";
                            echo "</td>";    
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
                </div><br>

                <a href="http://smarthome2.altervista.org/email_log_VarricchioArturo06.txt">Registro</a>

                <button onclick="popupOpen()">stato</button>
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
        </td>
    </tr>
</table>
<?php @include('shared/footer.php'); ?>