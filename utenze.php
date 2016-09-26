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
</style>
<div>
    <div onclick="setLed(93,14)" class="button" id="Gas">
        <img src="immagini/gas-on.svg" />
    </div>
    <div onclick="setLed(93,15)" class="button" id="Acqua">
        <img src="immagini/faucet.svg" />
    </div>
    <div onclick="setLed(93,13)" class="button" id="Anti">
        <img src="immagini/estintore-fuoco.svg" />
    </div>

    
</div>


<?php @include('shared/footer.php'); ?>