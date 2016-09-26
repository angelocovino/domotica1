<?php
    @include('shared/header.php');
?>
<?php
    $stanze = array(
        "cucina" => array(
            "luce" => saIO::led(2, 91),
            "luce piano" => saIO::led(3, 91),
            "luce tavolo snack" => saIO::led(5, 91)
        ),
        "Telo oscurante cucina" => array(
            "abbassa Telo oscurante" => saIO::led(18, 94)->setImage("immagini/arrowDown.svg", "immagini/arrowDown.svg"),
            "Alza Telo oscurante" => saIO::led(17, 94)->setImage("immagini/arrowUp.svg", "immagini/arrowUp.svg")
        ),
        "Finestra cucina" => array(
            "stato Finestra" => saIO::btn(2, 93)->setImage("immagini/TapparellaAlzata.svg", "immagini/TapparellaAbbassata.svg")
        ),
        "Finestra giorno" => array(
            "stato Finestra giorno" => saIO::btn(3, 93)->setImage("immagini/TapparellaAlzata.svg", "immagini/TapparellaAbbassata.svg")
        ),
        "Telo oscurante giorno" => array(
            "abbassa Telo oscurante giorno" => saIO::led(16, 94)->setImage("immagini/arrowDown.svg", "immagini/arrowDown.svg"),
            "Alza Telo oscurante giorno" => saIO::led(8, 94)->setImage("immagini/arrowUp.svg", "immagini/arrowUp.svg")
        ),
        "Telo oscurante cucina/salotto" => array(
            "abbassa Telo oscurante cucina/salotto" => saIO::led(7, 93)->setImage("immagini/arrowDown.svg", "immagini/arrowDown.svg"),
            "Alza Telo oscurante cucina/salotto" => saIO::led(6, 93)->setImage("immagini/arrowUp.svg", "immagini/arrowUp.svg")
        )
    );
    foreach($stanze as $nome => $luci){
        echo "<div class='stanza stanzaSingola'>";
            echo "<div class='fatti'>";
                foreach($luci as $luce => $led){
                    echo "<div class='fatto responsive'>";
                        echo "<table class='gestione_luci' cellspacing='0'>";
                            $str = "";
                            if($led instanceof saIO){
                                $str = $led->getData();
                            }
                            echo "<tr" . $str . ">";
                                echo "<td>";
                                    echo "<img src='immagini/lamp-3.svg' />";
                                echo "</td>";
                                echo "<td>";
                                    echo ucwords($luce);
                                echo "</td>";
                            echo "</tr>";
                        echo "</table>";
                    echo "</div>";
                }
            echo "</div>";
        echo "</div>";
    }
?>
<?php
    @include('shared/footer.php');
?>