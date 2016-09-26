<?php
    @include('shared/header.php');
?>
<?php
    $stanze = array(
        "Esterno" => array(
            "luce balcone" => saIO::led(4, 93),
            "luce scala condominio" => saIO::led(2, 93),
            "luce ripostiglio" => saIO::led(9, 93),
            "apri cancello pedonale" => saIO::led(1, 93)->setImage("immagini/arrowRight.svg", "immagini/arrowRight.svg"),
        ),
        "Porta blindata" => array(
            "Porta blindata" => saIO::btn(1, 93)->setImage("immagini/door-1.svg", "immagini/door.svg"),
            "apri" => saIO::led(3, 93)->setImage("immagini/arrowRight.svg", "immagini/arrowRight.svg")
        ),
        "elettrodomestici" => array(
            "irrigazione balcone" => saIO::led(5, 93)->setImage("immagini/socketPlugged.svg", "immagini/socket.svg")
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