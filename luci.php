<?php @include('shared/header.php'); ?>
<?php
    $stanze = array(
        "stanza andrea" => array(
            "luce" => saIO::led(12, 92),
            "soft" => saIO::led(13, 92)
            ),
        "stanza elisa" => array(
            "luce" => saIO::led(14, 92),
            "soft" => saIO::led(15, 92)
        ),
        "stanza tony" => array(
            "luce" => saIO::led(10, 92),
            "soft" => saIO::led(11, 92)
        ),
        "salone" => array(
            "luce tavolo giorno" => saIO::led(6, 91),
            "luce area giorno" => saIO::led(7, 91),
            "faretti parete tv" => saIO::led(10, 91)
        ),
        "salone led RGB" => array(
            "spegni" => saIO::rgb(95, true),
            "accendi/colora" => saIO::rgb(95)
        ),
        "salone led White" => array(
            "spegni" => saIO::white(95, true),
            "accendi/regola" => saIO::white(95)
        ),
        "cucina" => array(
            "luce" => saIO::led(2, 91),
            "luce piano" => saIO::led(3, 91),
            "luce tavolo snack" => saIO::led(5, 91)
        ),
        "matrimoniale" => array(
            "luce" => saIO::led(7, 92),
            "soft alina" => saIO::led(8, 92),
            "soft arturo" => saIO::led(9, 92)
        ),
        "matrimoniale led RGB" => array(
            "spegni" => saIO::rgb(97, true),
            "accendi/colora" => saIO::rgb(97)
        ),
        "matrimoniale led White" => array(
            "spegni" => saIO::white(97, true),
            "accendi/regola" => saIO::white(97)
        ),
        "esterno" => array(
            "luce balcone" => saIO::led(4, 93),
            "luce scala condominio" => saIO::led(2, 93),
            "luce ripostiglio" => saIO::led(9, 93)
        ),
        "ingresso" => array(
            "luce" => saIO::led(1, 91),
            "luce disimpegno notte" => saIO::led(1, 92)
        ),
        "bagno di servizio" => array(
            "luce" => saIO::led(2, 92),
            "luce area wc" => saIO::led(4, 92)
        ),
        "bagno ospiti" => array(
            "luce" => saIO::led(5, 92),
            "luce servizio" => saIO::led(6, 92),
            "luce specchio lavabi" => saIO::led(3, 92)
        ),
        "bagno ospiti led RGB" => array(
            "spegni" => saIO::rgb(96, true),
            "accendi/colora" => saIO::rgb(96)
        ),
        "bagno ospiti led White" => array(
            "spegni" => saIO::white(96, true),
            "accendi/regola" => saIO::white(96)
        )
    );
    foreach($stanze as $nome => $luci){
        echo "<div class='stanza'>";
            echo "<div class='titolo'>";
                //echo ucwords($nome);
                echo "&nbsp;&nbsp;<img src='immagini/down-arrow.svg' style='width:15px;' />&nbsp;&nbsp;";
                echo strtoupper($nome);
            echo "</div>";
            echo "<div class='fatti'>";
                foreach($luci as $luce => $led){
                    echo "<div class='fatto'>";
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
                                        echo "<input type='range' id='white_{$name[0]}' value='0' min='1' max='100' step='1' />";
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
<?php @include('shared/footer.php'); ?>