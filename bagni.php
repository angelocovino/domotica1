<?php
    @include('shared/header.php');
?>
<?php
    $stanze = array(
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
            "spegni" => saIO::led(0, 0),
            "accendi/colora" => saIO::rgb(96)
        ),
        "bagno ospiti led White" => array(
            "spegni" => saIO::white(96, true),
            "accendi/regola" => saIO::white(96)
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