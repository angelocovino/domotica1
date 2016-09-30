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
        <script src="js/jquery.min.js"></script>
        <script type="text/javascript" src="http://oap.accuweather.com/launch.js"></script>
        <script>
            window.addEventListener("load",function() {
                setTimeout(function(){
                    window.scrollTo(0, 1);
                }, 0);
            });
            function vaiA (pagina){
                document.location = pagina + '.php';
            }
            function indexResize(){
                $(".indexMenuEntry").width($(".indexMenuEntry").height());
                $("#indexContainer").css("margin-left", $("#indexMenuContainer").width());
            }
            
            var puntini = 0;
            function connessioneInCorso(){
                puntini++;
                var str = "Connessione in corso";
                switch(puntini){
                    case 1:
                        str += ".";
                        break;
                    case 2:
                        str += "..";
                        break;
                    case 3:
                        str += "...";
                        puntini = 0;
                        break;
                }
                $("#statoSchede").html(str).delay(1000).queue(function(next) {
                    connessioneInCorso();
                    next();
                });
            }
            
            function rilevaSchede(){
                connessioneInCorso();
                //var id = setTimeout(connessioneInCorso(), 2500);
                var ports = [91, 92, 93, 94, 95 , 96, 97];
                $("#statoSchede").bind()
                $.ajax({
                    dataType: "json",
                    type: "get",
                    url: "io/leggi.php",
                    data: {ports: ports}
                })
                .done(function(el){
                    var schedeOnline = true;
                    var schedeOffline = 0;
                    var str = "<span style='color:darkred; font-weight:bold;'>Offline</span> [";
                    $.each(el, function(port, portArray){
                        if(portArray.length < 1){
                            if(schedeOffline > 0){
                                str +=  ", ";
                            }
                            str += port;
                            schedeOnline = false;
                            schedeOffline++;
                        }
                    });
                    str += "].";
                    if((schedeOnline == false) && (el.length != schedeOffline)){
                        str += "<br />Restanti <span style='color:darkgreen; font-weight:bold;'>Online</span>."
                    }
                    if(schedeOnline == true){
                        str = "<span style='color:darkgreen; font-weight:bold;'>Online</span>.";
                    }
                    //clearTimeout(id);
                    $("#statoSchede").stop(true, true);
                    $("#statoSchede").html(str);
                })
                .error(function(obj,ErrorStr){
                    //clearTimeout(id);
                    $("#statoSchede").stop(true, true);
                    $("#statoSchede").html("Errore nel rilevare le schede.<br />Contattare un tecnico.<br />Dettagli Errore: " + ErrorStr);
                })
                .complete(function(xhr, textStatus){
                });
            }
            $(document).ready(function(){
                indexResize();
                rilevaSchede();
                $(window).resize(function() {
                    indexResize();
                });
            });
        </script>
    </head>
    <body>
        <?php
            include("shared/leftMenu.php");
        ?>
            <div id="indexContainer">
                <table id="indexTable" cellspacing="5px">
                    <tr>
                        <td colspan="2"><?php
                            echo date("d") . " ";
                            echo $months[date("n")] . " ";
                            echo date("Y");
                        ?></td>
                    </tr>
                    <tr id='indexWeather'>
                        <td colspan="2">
                            <a href="http://www.accuweather.com/en/it/vercelli/214754/weather-forecast/214754" class="aw-widget-legal">
                            </a><div id="awcc1475255118606" class="aw-widget-current"  data-locationkey="214754" data-unit="c" data-language="it" data-useip="false" data-uid="awcc1475255118606"></div>
                            <!--
                            <div><iframe  src="https://www.3bmeteo.com/moduli_esterni/localita_7_giorni_esteso/7742/ffffff/dcdcdc/5e5e5e/ffffff/it" width=382 height=287 frameborder="0"></iframe><br/><a href="http://www.3bmeteo.com/meteo/vercelli" ></a></div>
                            -->
                        </td>
                    </tr>
                    <tr>
                        <td>
                            temperature
                        </td>
                        <td>Stato schede: <span id="statoSchede">Connessione in corso</span></td>
                    </tr>
                    <tr>
                        <td>
                            sensore lux
                        </td>
                        <td>
                            consumi
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Eventi quotidiani<br /><br />
<?php
    @include("db/dbmanagement.php");
	function getParameter($name, $isCurrent = false){
		if(!$isCurrent){
			if(isset($_GET[$name])){
				return ($_GET[$name]);
			}
		}
		switch($name){
			case "year":
			case "y":
				return (date("Y"));
				break;
			case "month":
			case "m":
				return (date("n"));
				break;
			case "day":
			case "d":
				return (date("d"));
				break;
		}
		throw new Exception("ma che cazz m stai chierenn", 17);
		return (false);
	}
    function stampaEventi($day, $events, $limit = 2, $startOffset = 0, $exit = false){
        $count = $startOffset;
        if($limit > 0 && $limit >= $count){
            foreach($events[$day] as $oraInizio => $events){
                if($count >= $limit){
                    if(!$exit){
                        $exit = true;
                        echo "...";
                    }
                    break;
                }
                foreach($events as $index => $event){
                    if($count >= $limit){
                        if(!$exit){
                            $exit = true;
                            echo "...";
                        }
                        break;
                    }
                    echo "<div class='commandEvent'>";
                        echo $oraInizio;
                        echo "<div class='commandName'>";
                            //echo $events['id'] . " ";
                            echo strtolower($event['comandoNome']) . "<br />";
                        echo "</div>";
                    echo "</div>";
                    $count++;
                }
            }
        }
        return (array("count" => $count, "exit" => $exit));
    }
	
	$currentDay = getParameter("day", true);
	$currentMonth = getParameter("month", true);
	$currentYear = getParameter("year", true);
    
    $db = dbmanagment::open();
    $esempi = $db->getEventsWithParams($currentMonth, $currentYear);
    if(array_key_exists($currentDay, $esempi)){
        stampaEventi($currentDay, $esempi, 10);
    }
    
    $esempi = $db->getScheduledEventsWithParams();
    $weekDay = date('N', mktime(0, 0, 0, $currentMonth, 1, $currentYear));
    if(array_key_exists($weekDay, $esempi)){
        stampaEventi($weekDay, $esempi, 10);
    }
?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            esseci
                        </td>
                    </tr>
                </table>
            </div>
    </body>
</html>