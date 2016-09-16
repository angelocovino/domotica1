<?php @include('shared/header.php'); ?>
<script>
    var str;
    var climateOperations = ['automatic', 'manual', 'update'];
    function climateManagement(operation, scheda){
        if(climateOperations.indexOf(operation) > -1){
            switch(operation){
                case 'automatic':
                    str="SogliaTemp.htm?ReleTemp=1";
                    break;
                case 'manual':
                    str = "forms.htm?all=C";
                    break;
                case 'update':
                    str = "SogliaTemp.htm?soglia=" + $(".sogliaSelect").val();
                    break;
            }
            $.ajax({
                dataType: "json",
                type: "get",
                url: "http://domotica.smart.homepc.it:80" + scheda + "/" + str
            })
            .done(function(el){})
            .error(function(obj,str1){});
        }
    }
</script>
<?php
    class climate{
        public $name;
        public $port;
        
        public function __construct($name, $port){
            $this->name = $name;
            $this->port = $port;
        }
    }
    $climi = array(
        new climate("caldo", "91"),
        new climate("freddo", "93")
    );
    
    foreach($climi as $clima){
        echo "<div id='{$clima->name}'>";
            echo "<h1>{$clima->name}</h1>";
            echo "<select class='sogliaSelect'>";
                for($i=12; $i<37; $i+=0.5){
                    echo "<option value=\"{$i}\">{$i}</option>";
                }
            echo "</select>";
            echo "<button onClick=\"climateManagement('update',{$clima->port})\">Cambia soglia</button><br />";
            echo "Stato <span class='stato'></span><br />";
            echo "Temperatura <span class='temperature'></span><br />";
            echo "Soglia<span class='soglia'></span><br />";
            echo "Automatico<div onClick=\"climateManagement('automatic',{$clima->port})\"><img src='' class='automatico' /></div>";
            echo "Manuale<div onClick=\"climateManagement('manual',{$clima->port})\"><img src='' class='manuale' /></div>";
        echo "</div>";
    }
?>
<?php @include('shared/footer.php'); ?>