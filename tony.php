<?php
    @include('shared/header.php');
?>
<?php
    $stanze = array(
        "tony" => array(
            "luce" => saIO::led(10, 92),
            "soft" => saIO::led(11, 92)
        ),
        "serranda tony" => array(
            "stato serranda" => saIO::btn(9, 93)->setImage("immagini/TapparellaAbbassata.svg", "immagini/TapparellaAlzata.svg"),
            "abbassa" => saIO::led(9, 94),
            "alza" => saIO::led(1, 94)
        ),
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
                                    if($led->getImageOff() != false){
                                        echo "<img src='" . $led->getImageOff() . "' />";
                                    }else{
                                        echo "<img src='immagini/lamp-3.svg' />";
                                    }
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