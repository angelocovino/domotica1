<?php
    @include('shared/header.php');
?>
<?php
    $stanze = array(
        "salone" => array(
            "luce tavolo giorno" => saIO::led(6, 91),
            "luce area giorno" => saIO::led(7, 91),
            "faretti parete tv" => saIO::led(10, 91)
        ),
        "salone  led RGB" => array(
            "spegni led RGB" => saIO::led(0, 0),
            "accendi/colora led RGB" => saIO::rgb(95)
        ),
        "salone led White" => array(
            "spegni led White" => saIO::white(95, true),
            "accendi/regola led White" => saIO::white(95)
        ),
        "Finestra salotto" => array(
            "stato Finestra" => saIO::btn(4, 93)->setImage("immagini/TapparellaAlzata.svg", "immagini/TapparellaAbbassata.svg")
        ),
        "Telo oscurante salotto" => array(
            "abbassa Telo oscurante" => saIO::led(15, 94)->setImage("immagini/arrowDown.svg", "immagini/arrowDown.svg"),
            "Alza Telo oscurante" => saIO::led(7, 94)->setImage("immagini/arrowUp.svg", "immagini/arrowUp.svg")
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
                                    if(strpos($luce, "colora") != false){
                                        $name = explode(" ", $nome);
                                        echo "<input type='text' id='rgb_{$name[0]}' />";
                                    }elseif(strpos($luce, "regola") != false){
                                        $name = explode(" ", $nome);
                                        echo "<input type='range' id='white_{$name[0]}' value='50' min='1' max='100' step='1' />";
                                    }else{
                                        echo "<img src='immagini/lamp-3.svg' />";
                                    }
                                echo "</td>";
                                echo "<td>";
                                    if(strpos($luce, "regola") != false){
                                        echo "<span id='white_{$name[0]}_span'>50%</span>";
                                    }else{
                                        echo ucwords($luce);
                                    }
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