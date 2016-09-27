<?php
    @include('shared/header.php');
?>
<?php
    $stanze = array(
        "generali" => array(
            "luce" => saIO::led(2, 91),
            "luce piano" => saIO::led(3, 91),
            "luce tavolo snack" => saIO::led(5, 91)
        ),
        "Telo oscurante" => array(
            "abbassa" => saIO::led(18, 94)->setImage("immagini/arrowDownOn.svg", "immagini/arrowDown.svg"),
            "Alza" => saIO::led(17, 94)->setImage("immagini/arrowUpOn.svg", "immagini/arrowUp.svg")
        ),
        "Finestra cucina" => array(
            "stato" => saIO::btn(2, 93)->setImage("immagini/windowOpen.svg", "immagini/windowClose.svg")
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
            "carico forno" => saIO::led(14, 91)->setImage("immagini/socketPlugged.svg", "immagini/socket.svg"),
            "macchina caffe'" => saIO::led(4, 91)->setImage("immagini/socketPlugged.svg", "immagini/socket.svg")
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