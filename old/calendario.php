<?php include("include/header.php"); 
      include("include/dbmanagement.php");

$mesi = array(1=>'Gennaio', 'Febbraio', 'Marzo', 'Aprile',
                'Maggio', 'Giugno', 'Luglio', 'Agosto',
                'Settembre', 'Ottobre', 'Novembre','Dicembre');

$giorni = array(1=>'Lunedi','Martedi','Mercoledi',
                'Giovedi','Venerdi','Sabato','Domenica');
?>

<script>
  $( function() {
    $( "#datepicker" ).datepicker({minDate: 0});
      $("#SelectEventoTipo").change(function(){
          $(".tipologiaEvento").hide();
          $(".te" + $("#SelectEventoTipo").val()).show();
      })
  });
</script>

Evento <select name="Evento">
<option value="1">Accendi luce bagno</option>
<option value="2">Accendi condizionatore soggiorno</option>
</select><br>

Tipo evento
<select name="TipoEvento" id="SelectEventoTipo">
    <option selected value="-1"></option>
    <option value='1'>Data</option>
    <option value='2'>Giornaliero</option>
    <option value='3'>Settimanale</option>
    <option value='4'>Mensile</option>
</select><br>

<div class="DataEvent tipologiaEvento te1">
Evento per data 
<input type="text" id="datepicker" name="dataEvento"><br>
Ora inizio<input type="time" id="GiornalieroOraInizio" class="timepicker" name="TimeEvento"><br>
</div>

<div class="EventoGiorno tipologiaEvento te2">
Evento giornaliero
Ora inizio<input type="time" id="GiornalieroOraInizio" class="timepicker" name="GiornoTimeEvento"><br>
Durata<input type="number" value="0" name="GiornoDurataEvento"
</div>

<div class="EventoSettimanale tipologiaEvento te3">
Evento settimanale
<select name="Giorno">
    <?php
    foreach($giorni as $i => $g){
        echo "<option value='{$i}'>{$g}</option>";
    }
    ?>
</select><br>
Ora inizio<input type="time" id="SettimanaleOraInizio" class="timepicker" name="TimeEvento"><br>
</div>

<div class="EventoMensile tipologiaEvento te4">
Evento mensile
Giorno del mese<select name="mese">
   <?php for($i=1;$i<32;$i++){
        echo "<option value={$i}>{$i}</option>";
    }?>
</select><br>
Ora inizio<input type="time" id="MensileOraInizio" class="timepicker" name="TimeEvento"><br>
</div>
<input type="submit" value="Salva">

<?php include("include/footer.php"); ?>