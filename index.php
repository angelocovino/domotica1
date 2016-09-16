<!DOCTYPE html>
<html>
    <head>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
        <link href="css/index.css" rel="stylesheet" />
        <script>
            function vaiA (pagina){
                document.location = pagina + '.php';
            }
        </script>
    </head>
    <body>
        <table><tr><td style="vertical-align: middle; text-align: center;">
            <div id="container">
                <?php
                    @include('shared/utilities.php');
                    $i = 0;
                    foreach($menu as $svg => $titolo){
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
    </body>
</html>