<?php @include('shared/header.php'); ?>
<?php
    class climate{
        public $name;
        public $port;
        public $icon;
        
        public function __construct($name, $port){
            $this->name = $name;
            $this->port = $port;
        }
    }
    $climi = array(
        new climate("caldo", "91"),
        new climate("freddo", "93")
    );
?>
<table class='centeredContainer'>
    <tr>
        <td>
<?php
    foreach($climi as $clima){
        echo "<div class='bigDiv' id='{$clima->name}'>";
            echo "<h1>{$clima->name}, <span class='stato'>Spento</span></h1>";
            echo "<div class='bigDivChild'>";
                echo "<ul>";
                echo "<li>";
                    echo "Temperatura: <span class='temperature'>-</span><br />";
                echo "</li>";
                echo "<li>";
                    echo "Soglia: <span class='soglia'></span><br />";
                    echo "<div class='comparoScomparo'>";
                        echo "Cambia: <select class='sogliaSelect'>";
                            for($i=12; $i<37; $i+=0.5){
                                echo "<option value=\"{$i}\">{$i}</option>";
                            }
                        echo "</select>";
                        echo "<button onClick=\"climateManagement('{$clima->name}', 'update',{$clima->port})\">Salva</button><br />";
                    echo "</div>";
                echo "</li>";
                echo "<li>";
                    echo "<span class='automaticManual'>Automatico/Manuale</span><br />";
                    echo "<div class='comparoScomparo'>";
                        echo "<div class='automatico' onClick=\"climateManagement('{$clima->name}', 'automatic',{$clima->port})\"><img src='immagini/switchOff.svg' class='automatico' /> Automatico</div>";
                        echo "<div class='manuale' onClick=\"climateManagement('{$clima->name}', 'manual',{$clima->port})\"><img src='immagini/switchOff.svg' class='manuale' /> Manuale</div>";
                    echo "</div>";
                echo "</li>";
                echo "</ul>";
            echo "</div>";
        echo "</div>";
    }
?>
        </td>
    </tr>
</table>
<?php @include('shared/footer.php'); ?>