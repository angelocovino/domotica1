<?php @include('shared/header.php'); ?>
<?php
    $gestioni = array(
        "gestione totale" => array(
            "apertura" => saIO::led(19, 94)->setImage("immagini/arrowRightOn.svg", "immagini/arrowRight.svg"),
            "chiusura" => saIO::led(20, 94)->setImage("immagini/arrowLeftOn.svg", "immagini/arrowLeft.svg")
        ),
        "gestione parziale" => array(
            "apertura 50%" => saIO::led(22, 94)->setImage("immagini/arrowRightOn.svg", "immagini/arrowRight.svg"),
            "apertura estiva" => saIO::led(21, 94)->setImage("immagini/arrowRightOn.svg", "immagini/arrowRight.svg")
        )
    );
    $stanze = array(
       "cancello pedonale" => array(
            "apri" => saIO::led(1, 93)->setImage("immagini/arrowRightOn.svg", "immagini/arrowRight.svg")
        ),
        "Porta blindata" => array(
            "stato" => saIO::btn(1, 93)->setImage("immagini/door-1.svg", "immagini/door.svg"),
            "apri" => saIO::led(3, 93)->setImage("immagini/arrowRightOn.svg", "immagini/arrowRight.svg")
        ),
        "Finestra cucina" => array(
            "stato" => saIO::btn(2, 93)->setImage("immagini/windowOpen.svg", "immagini/windowClose.svg")
        ),
        "Telo oscurante cucina" => array(
            "abbassa" => saIO::led(18, 94),
            "Alza" => saIO::led(17, 94)
        ),
        "Finestra giorno" => array(
            "stato" => saIO::btn(3, 93)->setImage("immagini/windowOpen.svg", "immagini/windowClose.svg")
        ),
        "Telo oscurante giorno" => array(
            "abbassa" => saIO::led(16, 94),
            "Alza" => saIO::led(8, 94)
        ),
        "Finestra salotto" => array(
            "stato" => saIO::btn(4, 93)->setImage("immagini/windowOpen.svg", "immagini/windowClose.svg")
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
            "stato" => saIO::btn(5, 93)->setImage("immagini/windowOpen.svg", "immagini/windowClose.svg")
        ),
        "Telo oscurante Andrea" => array(
            "abbassa" => saIO::led(14, 94),
            "Alza" => saIO::led(6, 94)
        ),
        "Finestra Elisa" => array(
            "stato" => saIO::btn(6, 93)->setImage("immagini/windowOpen.svg", "immagini/windowClose.svg")
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
                //foreach($luci as $luce => $led){
                    echo "<div class='fatto'>";
                        echo "<table cellspacing='0'>";
                            $str = "";
                            $name = "";
                            if(isset($luci['apertura']) && ($luci['apertura'] instanceof saIO)){ 
                                $str = $luci['apertura']->getData(); 
                                $name = "apertura";
                            }else if(isset($luci['apertura 50%']) && ($luci['apertura 50%'] instanceof saIO)){ 
                                $str = $luci['apertura 50%']->getData();
                                $name = "apertura 50%";
                            }
                            if(!empty($str)){
                                echo "<tr" . $str . ">";
                                    echo "<td>";
                                        if(isset($luci['apertura']) && $luci['apertura']->getImageOff() != false){
                                            echo "<img src='" . $luci['apertura']->getImageOff() . "' />";
                                        }elseif(isset($luci['apertura 50%']) && $luci['apertura 50%']->getImageOff() != false){
                                            echo "<img src='" . $luci['apertura 50%']->getImageOff() . "' />";
                                        }else{
                                            echo "<img src='immagini/TapparellaAlzata.svg' />";
                                        }
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
                            $name = "";
                            if(isset($luci['chiusura']) && ($luci['chiusura'] instanceof saIO)){ 
                                $str = $luci['chiusura']->getData(); 
                                $name = "chiusura";
                            }else if(isset($luci['apertura estiva']) && ($luci['apertura estiva'] instanceof saIO)){ 
                                $str = $luci['apertura estiva']->getData();
                                $name = "apertura estiva";
                            }
                            if(!empty($str)){
                                echo "<tr" . $str . ">";
                                    echo "<td>";
                                        if(isset($luci['chiusura']) && $luci['chiusura']->getImageOff() != false){
                                            echo "<img src='" . $luci['chiusura']->getImageOff() . "' />";
                                        }elseif(isset($luci['apertura estiva']) && $luci['apertura estiva']->getImageOff() != false){
                                        echo "<img src='" . $luci['apertura estiva']->getImageOff() . "' />";
                                    }else{
                                            echo "<img src='immagini/TapparellaAlzata.svg' />";
                                        }
                                    echo "</td>";
                                    echo "<td>";
                                        echo ucwords($name);
                                    echo "</td>";
                                echo "</tr>";
                            }
                        echo "</table>";
                    echo "</div>";
                //}
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
                                    if($luci['stato']->getImageOff() != false){
                                        echo "<img src='" . $luci['stato']->getImageOff() . "' />";
                                    }else{
                                        echo "<img src='immagini/TapparellaAlzata.svg' />";
                                    }
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
                                        if(isset($luci['apri']) && $luci['apri']->getImageOff() != false){
                                            echo "<img src='" . $luci['apri']->getImageOff() . "' />";
                                        }else{
                                            echo "<img src='immagini/arrowDown.svg' />";
                                        }
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
                                    if(isset($luci['Alza']) && $luci['Alza']->getImageOff() != false){
                                        echo "<img src='" . $luci['Alza']->getImageOff() . "' />";
                                    }else{
                                        echo "<img src='immagini/arrowUp.svg' />";
                                    }
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
