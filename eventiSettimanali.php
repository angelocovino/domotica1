<?php @include('shared/header.php'); ?>
<?php
    @include("db/dbmanagement.php");
    $db = dbmanagment::open();
    $esempi = $db->getScheduledEventsWithParams();
    $comandi = $db->getComando();
?>
		<script>
<?php
    echo "var events=" . json_encode($esempi) . ";";
    echo "var comandi=" . json_encode($comandi) . ";";
    
    function stampaEventi($day, $events){
        foreach($events[$day] as $oraInizio => $events){
            foreach($events as $index => $event){
                echo "<div class='commandEvent'>";
                    echo $oraInizio;
                    echo "<div class='commandName'>";
                        echo strtolower($event['comandoNome']) . "<br />";
                    echo "</div>";
                echo "</div>";
            }
        }
    }
?>
		</script>
		<div id="calendarEventPopup">
			<div id="calendarEventClose">&nbsp;</div>
			<div id="calendarEventDate">&nbsp;</div>
			<div id="calendarEvents"></div>
		</div>
		<div id="calendarContainer">
<?php
			echo "<h3>";
                echo "gestione eventi settimanali";
            echo "</h3>";
			echo "<table cellspacing='6px' cellpadding='0' id='calendarTable'>";  
				echo "<thead>";
					echo "<tr>";
						for($day=0; $day<7; $day++){
							echo "<th>{$days[$day]}</th>";
						}
					echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
					echo "<tr>";
						for($day=0; $day<7; $day++){
							echo "<td data-day='{$day}' class='day noMargin'>";
								echo "<div class='dayEvents'>";
									if(array_key_exists($day, $esempi)){
										stampaEventi($day, $esempi);
									}
								echo "</div>";
							echo "</td>";
						}
					echo "</tr>";
				echo "</tbody>"; 
			echo "</table>";
			echo "<div id='calendarCells'>";
						for($day=0; $day<7; $day++){
                            echo "<div data-day='{$day}' class='day'>";
								echo "<div class='dayNumber'>{$days[$day]}</div>";
								echo "<div class='dayEvents'>";
                                    if(array_key_exists($day, $esempi)){
                                        stampaEventi($day, $esempi);
                                    }
                                echo "</div>";
                            echo "</div>";
						}
			echo "</div>";
?>
		</div>
<?php @include('shared/footer.php'); ?>