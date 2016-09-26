<?php
    @include('shared/header.php');
?>
<?php
    $stanze = array(
        "matrimoniale" => array(
            "luce" => saIO::led(7, 92),
            "soft alina" => saIO::led(8, 92),
            "soft arturo" => saIO::led(9, 92)
        ),
        "matrimoniale led RGB" => array(
            "spegni led RGB" => saIO::led(0, 0),
            "accendi/colora led RGB" => saIO::rgb(97)
        ),
        "matrimoniale led White" => array(
            "spegni led white" => saIO::white(97, true),
            "accendi/regola led white" => saIO::white(97)
        ),
        "serranda matrimoniale" => array(
            "stato serranda" => saIO::btn(7, 93)->setImage("immagini/TapparellaAlzata.svg", "immagini/TapparellaAbbassata.svg"),
            "abbassa serranda" => saIO::led(12, 94)->setImage("immagini/arrowDown.svg", "immagini/arrowDown.svg"),
            "Alza serranda" => saIO::led(4, 94)->setImage("immagini/arrowUp.svg", "immagini/arrowUp.svg")
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