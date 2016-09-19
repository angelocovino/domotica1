<?php @include('shared/header.php'); ?>
<?php
    $gestioni = array(
        "gestione totale" => array(
            "apertura" => saIO::led(19, 94),
            "chiusura" => saIO::led(20, 94)
        ),
        "gestione parziale" => array(
            "apertura 50%" => saIO::led(22, 94),
            "apertura estiva" => saIO::led(21, 94)
        )
    );
    $stanze = array(
       "cancello pedonale" => array(
            "apri" => saIO::led(1, 93),
            ),
        "Porta blindata" => array(
            "stato" => saIO::btn(1, 93),
            "apri" => saIO::led(3, 93),
            ),
        "Finestra cucina" => array(
            "stato" => saIO::btn(2, 93)
        ),
        "Telo oscurante cucina" => array(
            "abbassa" => saIO::led(18, 94),
            "Alza" => saIO::led(17, 94)
        ),
        "Finestra giorno" => array(
            "stato" => saIO::btn(3, 93)
        ),
        "Telo oscurante giorno" => array(
            "abbassa" => saIO::led(16, 94),
            "Alza" => saIO::led(8, 94)
        ),
        "Finestra salotto" => array(
            "stato" => saIO::btn(4, 93)
        ),
        "Telo oscurante salotto" => array(
            "abbassa" => saIO::led(15, 94),
            "Alza" => saIO::led(7, 94)
        ),
        "Telo oscurante cucina/salotto" => array(
            "abbassa" => saIO::led(7, 93),
            "Alza" => saIO::led(6, 93)
        ),
        "Finestra Andrea" => array(
            "stato" => saIO::btn(5, 93),
        ),
        "Telo oscurante Andrea" => array(
            "abbassa" => saIO::led(14, 94),
            "Alza" => saIO::led(6, 94)
        ),
        "Finestra Elisa" => array(
            "stato" => saIO::btn(6, 93)
        ),
        "Telo oscurante Elisa" => array(
            "abbassa" => saIO::led(13, 94),
            "Alza" => saIO::led(5, 94)
        ),
        "serranda matrimoniale" => array(
            "stato" => saIO::btn(7, 93),
            "abbassa" => saIO::led(12, 94),
            "Alza" => saIO::led(4, 94)
        ),
        "serranda tony" => array(
            "stato" => saIO::btn(9, 93),
            "abbassa" => saIO::led(9, 94),
            "Alza" => saIO::led(1, 94)
        ),
        "serranda bagno di servizio " => array(
            "stato" => saIO::btn(9, 93),
            "abbassa" => saIO::led(10, 94),
            "Alza" => saIO::led(2, 94)
        ),
        "serranda bagno ospiti" => array(
            "stato" => saIO::btn(10, 93),
            "abbassa" => saIO::led(11, 94),
            "Alza" => saIO::led(3, 94)
        )
    );
    foreach($gestioni as $nome => $luci){
        echo "<div class='stanza'>";
            echo "<div class='titolo'>";
                echo "&nbsp;&nbsp;<img src='immagini/down-arrow.svg' style='width:15px;' />&nbsp;&nbsp;";
                echo strtoupper($nome);
            echo "</div>";
            echo "<div class='fatti'>";
                foreach($luci as $luce => $led){
                    echo "<div class='fatto'>";
                        echo "<table cellspacing='0'>";
                            echo "<tr" . $led->getData() . ">";
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
    foreach($stanze as $nome => $luci){
        echo "<div class='stanza'>";
            echo "<div class='titolo'>";
                echo "&nbsp;&nbsp;<img src='immagini/down-arrow.svg' style='width:15px;' />&nbsp;&nbsp;";
                echo strtoupper($nome);
            echo "</div>";
            echo "<div class='fatti'>";
                    echo "<div class='fatto'>";
                        if(isset($luci['stato'])){
                            $str = $luci['stato']->getData();
                            echo "<table cellspacing='0'>";
                                echo "<tr" . $str . ">";
                                echo "<td>";
                                    echo "<img src='immagini/lamp-3.svg' />";
                                echo "</td>";
                                echo "<td>";
                                    echo "Aperto/Chiuso";
                                echo "</td>";
                            echo "</tr>";
                            echo "</table>";
                        }
                    echo "</div>";
                    echo "<div class='fatto'>";
                        echo "<table cellspacing='0'>";
                            $str = "";
                            $name = "";
                            if(isset($luci['abbassa']) && ($luci['abbassa'] instanceof saIO)){ 
                                $str = $luci['abbassa']->getData();
                                $name = "abbassa";
                            }else if(isset($luci['apri']) && ($luci['apri'] instanceof saIO)){ 
                                $str = $luci['apri']->getData();
                                $name = "apri";
                            }
                            if(!empty($str)){
                                echo "<tr" . $str . ">";
                                    echo "<td>";
                                        echo "<img src='immagini/lamp-3.svg' />";
                                    echo "</td>";
                                    echo "<td>";
                                        echo ucwords($name);
                                    echo "</td>";
                                echo "</tr>";
                            }
                        echo "</table>";
                    echo "</div>";
                    echo "<div class='fatto'>";
                        echo "<table cellspacing='0'>";
                            $str = "";
                            if(isset($luci['Alza']) && ($luci['Alza'] instanceof saIO)){ $str = $luci['Alza']->getData(); 
                                echo "<tr" . $str . ">";
                                echo "<td>";
                                    echo "<img src='immagini/lamp-3.svg' />";
                                echo "</td>";
                                echo "<td>";
                                    echo ucwords("alza");
                                echo "</td>";
                            echo "</tr>";
                            }
                        echo "</table>";
                    echo "</div>";
            echo "</div>";
        echo "</div>";
    }
?>
<?php @include('shared/footer.php'); ?>