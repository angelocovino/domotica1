<?php
    @include('shared/header.php');
?>
<?php
    $stanze = array(
        "stanza andrea" => array(
            "luce" => saIO::led(12, 92),
            "soft" => saIO::led(13, 92)
        ),
        "Finestra Andrea" => array(
            "stato Finestra" => saIO::btn(5, 93)->setImage("immagini/TapparellaAlzata.svg", "immagini/TapparellaAbbassata.svg")
        ),
        "Telo oscurante Andrea" => array(
            "abbassa Telo oscurante" => saIO::led(14, 94)->setImage("immagini/arrowDown.svg", "immagini/arrowDown.svg"),
            "Alza Telo oscurante" => saIO::led(6, 94)->setImage("immagini/arrowUp.svg", "immagini/arrowUp.svg")
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