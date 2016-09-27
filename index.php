<!DOCTYPE html>
<html>
    <head>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        
        <META NAME="author"         CONTENT="ESSECI.srls & GRASSO AUTOMATION s.r.l" />
        <META NAME="description"    CONTENT="Gestione domotica"/>
        <META NAME="robots"         CONTENT="none" />
        <META NAME="DC"             CONTENT=”ita” language SCHEME=”RFC1766″ />
        
        
        <link href="immagini/favicon.png" rel="apple-touch-icon" />
        <link href="immagini/favicon-32x32.png" rel="apple-touch-icon" sizes="32x32"/>
        <link href="immagini/favicon-64x64.png" rel="apple-touch-icon" sizes="64x64"/>
        <link href="immagini/favicon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
        <link href="immagini/favicon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
        <link href="immagini/favicon-152x152.png" rel="apple-touch-icon" sizes="152x152" />
        <link href="immagini/favicon-180x180.png" rel="apple-touch-icon" sizes="180x180" />
        <link href="immagini/favicon-192x192.png" rel="apple-touch-icon" sizes="192x192" />
        <link href="immagini/favicon-128x128.png" rel="apple-touch-icon" sizes="128x128" />
        <link href="immagini/favicon.png" rel="icon" />
        <link href="immagini/favicon-32x32.png" rel="icon" sizes="32x32"/>
        <link href="immagini/favicon-64x64.png" rel="icon" sizes="64x64"/>
        <link href="immagini/favicon-76x76.png" rel="icon" sizes="76x76" />
        <link href="immagini/favicon-120x120.png" rel="con" sizes="120x120" />
        <link href="immagini/favicon-152x152.png" rel="icon" sizes="152x152" />
        <link href="immagini/favicon-180x180.png" rel="icon" sizes="180x180" />
        <link href="immagini/favicon-192x192.png" rel="icon" sizes="192x192" />
        <link href="immagini/favicon-128x128.png" rel="icon" sizes="128x128" />
        
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
        <link href="css/index.css" rel="stylesheet" />
        <script>
            window.addEventListener("load",function() {
                setTimeout(function(){
                    window.scrollTo(0, 1);
                }, 0);
            });
            function vaiA (pagina){
                document.location = pagina + '.php';
            }
        </script>
    </head>
    <body>
        <table id="tabellaCentrativa" class="noHeader"><tr><td>
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