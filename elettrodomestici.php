<?php @include('shared/header.php'); ?>
<?php
    $stanze = array(
        "salone" => array(
            "presa comandata 1" => saIO::led(9, 91),
            "presa comandata 2" => saIO::led(11, 91),
            "presa comandata 3" => saIO::led(12, 91)
        ),
        "cucina" => array(
            "carico forno" => saIO::led(14, 91),
            "macchina caffe'" => saIO::led(4, 91)
        ),
        "esterno" => array(
            "irrigazione balcone" => saIO::led(5, 93),
        ),
        "ingresso" => array(
            "carico asciugatrice" => saIO::led(16, 91)
        ),
        "bagno di servizio" => array(
            "estrattore" => saIO::led(16, 92),
            "boiler" => saIO::led(13, 91),
            "carico lavatrice" => saIO::led(15, 91)
        )
    );
    foreach($stanze as $nome => $presa){
        echo "<div class='stanza'>";
            echo "<div class='titolo'>";
                //echo ucwords($nome);
                echo "&nbsp;&nbsp;<img src='immagini/down-arrow.svg' style='width:15px;' />&nbsp;&nbsp;";
                echo strtoupper($nome);
            echo "</div>";
            echo "<div class='fatti'>";
                foreach($presa as $luce => $led){
                    echo "<div class='fatto'>";
                        echo "<table class='gestione_luci' cellspacing='0'>";
                            $str = "";
                            if($led instanceof saIO){
                                $str = $led->getData();
                            }
                            echo "<tr" . $str . ">";
                                echo "<td>";
                                    echo "<img src='immagini/socket.svg' />";
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
<?php @include('shared/footer.php'); ?>