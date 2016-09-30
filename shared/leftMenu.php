<div id="indexMenuContainer">
    <?php
        @include('shared/utilities.php');
        $i = 0;
        if(isset($pagina) && strcasecmp("index", $pagina) != 0){
            $menu = array("cabin" => "index") + $menu;
        }
        foreach($menu as $svg => $titolo){
            if((isset($pagina) && strcasecmp($titolo, $pagina) != 0) || !isset($pagina)){
                $i++;
                $temp = explode(" ", $titolo);
                $temp = $temp[0];
                $pageTitle = ucwords(strtolower($titolo));
                echo "<div class='indexMenuEntry' onclick='vaiA(\"" . $temp . "\");'>";
                    echo "<img class='icona' src='immagini/" . $svg . ".svg' title='{$pageTitle}' alt='{$pageTitle}'>"; // . $titolo;
                echo "</div>";
            }
        }
    ?>
</div>