<?php @include('shared/header.php'); ?>
<div class="content">
    <h3>Area giorno</h3>
    <div class="table sun">
        <div class="button" id="U" onclick="setLed('91','U','all')"><table><tr><td>Accendi</td></tr></table></div>
        <div class="button" id="V" onclick="setLed('91','V','all')"><table><tr><td>Spegni</td></tr></table></div>
    </div><br />
    <h3>Area notte</h3>
    <div class="table moon">
        <div class="button" id="2" onclick="setLed('91','2','all')"><table><tr><td>Accendi</td></tr></table></div>
        <div class="button" id="1" onclick="setLed('91','1','all')"><table><tr><td>Spegni</td></tr></table></div>
    </div><br />
    <h3>Intero appartamento</h3>
    <div class="table bulb">
        <div class="button" id="Y" onclick="setLed('91','Y','all')"><table><tr><td>Accendi</td></tr></table></div>
        <div class="button" id="W" onclick="setLed('91','W','all')"><table><tr><td>Spegni</td></tr></table></div>
    </div><br />
    <br /><br />
    <div class="single">
        <div class="button" id="X" onclick="setLed('91','X','all')">
            Modalita' Relax<br />
            <img src="immagini/sofa.svg" />
        </div>
    </div>
    <div class="single">
        <div class="button" id="L" onclick="setLed('91','L','all')">
            Modalita' Cinema<br />
            <img src="immagini/video-camera.svg" />
        </div>
    </div>
    <div class="single">
        <div class="button" id="Z" onclick="setLed('91','Z','all')">
            Modalita' Ospite<br />
            <img src="immagini/ospite.svg" />
        </div>
    </div>
</div>
<?php @include('shared/footer.php'); ?>