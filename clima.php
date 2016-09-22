<?php @include('shared/header.php'); ?>
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