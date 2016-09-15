<?php @include('shared/header.php'); ?>
<script>
    var ports = [91, 92, 93, 95, 96, 97];
    function appicciaStuta (elem, isClick = false){
        if(elem.target){
            var tr = $(elem.currentTarget);
            isClick = elem.data.isClick;
        }else{
            var tr = $(elem);
        }
        var port = tr.attr('data-port');
        var led = tr.attr('data-led');
        var img = tr.find("img");
        if(isClick){
            setLed(port, led);
        }else{
            if(tr.attr("data-acceso") == 1){
                img.attr("src", lampadinaAccesa);
            }else if(tr.attr("data-acceso") == 0){
                img.attr("src", lampadinaSpenta);
            }
        }
    }
    $(document).ready(function(){
        reloadColor("ffffff", "salone");
        reloadColor("ffffff", "matrimoniale");
        reloadColor("ffffff", "bagno");
    });
</script>
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
            "spegni" => saIO::led(0, 0),
            "accendi/colora" => false
        ),
        "salone led White" => array(
            "spegni" => saIO::led(0, 0),
            "accendi/regola" => false
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
            "spegni" => saIO::led(0, 0),
            "accendi/colora" => false
        ),
        "matrimoniale led White" => array(
            "spegni" => saIO::led(0, 0),
            "accendi/regola" => false
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
            "spegni" => saIO::led(0, 0),
            "accendi/colora" => false
        ),
        "bagno ospiti led White" => array(
            "spegni" => saIO::led(0, 0),
            "accendi/regola" => false
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
                    echo "<div class='fatto responsive'>";
                        echo "<table class='gestione_luci' cellspacing='0'>";
                            $str = "";
                            if($led instanceof saIO && (strpos($luce, "colora") == false)){
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
<?php @include('shared/footer.php'); ?>