<?php @include('shared/header.php'); ?>
<table class='centeredContainer'>
    <tr>
        <td>
            <div>
                <div onclick="setLed(93,14)" data-enabled="0" class="button" id="Gas">
                    GAS
                    <img src="immagini/gas-off.svg" />
                    <span>spento</span>
                </div>
                <div onclick="setLed(93,15)" data-enabled="0" class="button" id="Acqua">
                    Acqua
                    <img src="immagini/faucet-off.svg" />
                    <span>chiusa</span>
                </div>
                <div onclick="setLed(93,13)" data-enabled="0" class="button" id="Anti">
                    Antincendio
                    <img src="immagini/extinguisher.svg" />
                    <span>disattivo</span>
                </div>


            </div>
        </td>
    </tr>
</table>
<?php @include('shared/footer.php'); ?>