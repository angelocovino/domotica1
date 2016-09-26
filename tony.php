<?php
    @include('shared/header.php');
?>
<?php
    $stanze = array(
        "generali" => array(
            "luce" => saIO::led(10, 92),
            "soft" => saIO::led(11, 92)
        ),
        "serranda" => array(
            "stato" => saIO::btn(9, 93)->setImage("immagini/TapparellaAlzata.svg", "immagini/TapparellaAbbassata.svg"),
            "abbassa" => saIO::led(9, 94)->setImage("immagini/arrowDown.svg", "immagini/arrowDown.svg"),
            "alza" => saIO::led(1, 94)->setImage("immagini/arrowUp.svg", "immagini/arrowUp.svg")
        )
    );
    foreach($stanze as $nome => $luci){
        echo "<div class='stanza stanzaSingola'>";
            echo "<div class='titolo'>";
                echo "&nbsp;&nbsp;<img src='immagini/down-arrow.svg' style='width:15px;' />&nbsp;&nbsp;";
                echo strtoupper($nome);
            echo "</div>";
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