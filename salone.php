<?php
    @include('shared/header.php');
?>
<?php
    $stanze = array(
        "generali" => array(
            "luce tavolo giorno" => saIO::led(6, 91),
            "luce area giorno" => saIO::led(7, 91),
            "faretti parete tv" => saIO::led(10, 91)
        ),
        "salone led RGB" => array(
            "spegni led RGB" => saIO::rgb(95, true),
            "accendi/colora led RGB" => saIO::rgb(95)
        ),
        "salone led White" => array(
            "spegni led White" => saIO::white(95, true),
            "accendi/regola led White" => saIO::white(95)
        ),
        "Finestra salone" => array(
            "stato" => saIO::btn(4, 93)->setImage("immagini/windowOpen.svg", "immagini/windowClose.svg")
        ),
        "Telo oscurante salone" => array(
            "abbassa" => saIO::led(15, 94)->setImage("immagini/arrowDownOn.svg", "immagini/arrowDown.svg"),
            "Alza" => saIO::led(7, 94)->setImage("immagini/arrowUpOn.svg", "immagini/arrowUp.svg")
        ),
        "Finestra giorno" => array(
            "stato" => saIO::btn(3, 93)->setImage("immagini/windowOpen.svg", "immagini/windowClose.svg")
        ),
        "Telo oscurante giorno" => array(
            "abbassa" => saIO::led(16, 94)->setImage("immagini/arrowDownOn.svg", "immagini/arrowDown.svg"),
            "Alza" => saIO::led(8, 94)->setImage("immagini/arrowUpOn.svg", "immagini/arrowUp.svg")
        ),
        "Telo oscurante cucina/salone" => array(
            "abbassa" => saIO::led(7, 93)->setImage("immagini/arrowDownOn.svg", "immagini/arrowDown.svg"),
            "Alza" => saIO::led(6, 93)->setImage("immagini/arrowUpOn.svg", "immagini/arrowUp.svg")
        ),
        "elettrodomestici" => array(
            "presa comandata 1" => saIO::led(9, 91)->setImage("immagini/socketPlugged.svg", "immagini/socket.svg"),
            "presa comandata 2" => saIO::led(11, 91)->setImage("immagini/socketPlugged.svg", "immagini/socket.svg"),
            "presa comandata 3" => saIO::led(12, 91)->setImage("immagini/socketPlugged.svg", "immagini/socket.svg")
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
<?php
    @include('shared/footer.php');
?>