<?php
    @include('shared/header.php');
?>
<?php
    $stanze = array(
        "ingresso" => array(
            "luce" => saIO::led(1, 91),
            "luce disimpegno notte" => saIO::led(1, 92)
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