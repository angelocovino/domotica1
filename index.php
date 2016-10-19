<!DOCTYPE html>
<html>
    <head>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <link rel="shortcut icon" type="image/png" href="immagini/favicon.png"/>
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

<!--
<!DOCTYPE html>
<html>
    <head>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <link rel="shortcut icon" type="image/png" href="immagini/favicon.png"/>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
        <link href="css/index.css" rel="stylesheet" />
        <script src="js/jquery.min.js"></script>
        <script>
            function vaiA (pagina){
                document.location = pagina + '.php';
            }
            $(document).ready(function(){
                var below768 = false;
                if($(window).width() < 768){
                    below768 = true; 
                    $("object.icona").height($("object.icona").width());
                }
                $(window).resize(function() {
                    if(below768 && $(window).width()>767){
                        below768 = false;
                        $("object.icona").height("100px");
                    }else if(!below768 && $(window).width()<768){
                        below768 = true;
                        $("object.icona").height($("object.icona").width());
                    }else if(below768 && $(window).width()<768){
                        $("object.icona").height($("object.icona").width());
                    }
                });
                $("object.icona").click(function(){
                    alert("asd");
                    var link = $(this).parent().attr("onclick");
                    alert(link);
                });
            });
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
                        //echo "<div onclick='vaiA(\"" . $temp . "\");'>";
                        echo "<div>";
                            echo "<object class='icona' type='image/svg+xml' data='immagini/" . $svg . ".svg'>test</object><br />" . $titolo;
                            //echo "<img class='icona' src='immagini/" . $svg . ".svg'><br />" . $titolo;
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
-->