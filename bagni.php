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
            "spegni led RGB" => saIO::rgb(96, true),
            "accendi/colora led RGB" => saIO::rgb(96)
        ),
        "bagno ospiti led White" => array(
            "spegni led white" => saIO::white(96, true),
            "accendi/regola led white" => saIO::white(96)
        ),
        "elettrodomestici" => array(
            "estrattore" => saIO::led(16, 92)->setImage("immagini/socketPlugged.svg", "immagini/socket.svg"),
            "boiler" => saIO::led(13, 91)->setImage("immagini/socketPlugged.svg", "immagini/socket.svg"),
            "carico lavatrice" => saIO::led(15, 91)->setImage("immagini/socketPlugged.svg", "immagini/socket.svg")
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