<?php
    @include('shared/header.php');
?>
    <table id="tabellaCentrativa"><tr><td>
        <div id="container">
            <?php
                $i = 0;
                foreach($perimetro as $svg => $titolo){
                    $i++;
                    $temp = explode(" ", $titolo);
                    $temp = $temp[0];
                    echo "<div onclick='vaiA(\"" . $temp . "\");'>";
                        echo "<img class='icona' src='immagini/" . $svg . ".svg'><br />" . $titolo;
                    echo "</div>";
                    if($i%3 == 0){
                        echo "<br />";
                    }
                }
            ?>
        </div>
    </td></tr></table>
<!--
    <div style="width: 100%; height: calc(100% - 70px);">
        <svg id="svgload"
             style="width: 100%; height: 100%;"
             viewBox="0 0 1500 1500"
         ></svg>
    </div>
-->
<?php
    @include('shared/footer.php');
?>