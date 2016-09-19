<?php @include('shared/header.php'); ?>

    <button>Attiva allarme totale</button>
    <button>Attiva allarme parziale</button>
    Stato <span id="statoAllarme"></span>
    <progress style="display:none" id="loadBar" value="1" max="60"></progress>

<?php @include('shared/footer.php'); ?>