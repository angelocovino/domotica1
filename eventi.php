<?php @include('shared/header.php'); ?>
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
	
	$currentDay = getParameter("day", true);
	$currentMonth = getParameter("month", true);
	$currentYear = getParameter("year", true);
	$month = getParameter("month");
	$year = getParameter("year");

    $db = new dbmanagment();
    $db->opendatabase();
    $db->createDB();
    $esempi = $db->getEventsWithParams($month, $year);
    $comandi = $db->getComando();
	
	$countDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	
	$months = array(
		1 => 'Gennaio',
		'Febbraio',
		'Marzo',
		'Aprile',
		'Maggio',
		'Giugno',
		'Luglio',
		'Agosto',
		'Settembre',
		'Ottobre',
		'Novembre',
		'Dicembre'
	);

	$days = array(
		'Lunedi',
		'Martedi',
		'Mercoledi',
		'Giovedi',
		'Venerdi',
		'Sabato',
		'Domenica'
	);
?>
		<script>
			<?php
				echo "var events=" . json_encode($esempi) . ";";
				echo "var comandi=" . json_encode($comandi) . ";";
				echo "var currentMonth=" . $currentMonth . ";";
				echo "var currentYear=" . $currentYear . ";";
				echo "var month=" . $month . ";";
				echo "var year=" . $year . ";";
			?>
		</script>
		<div id="popupBackground">&nbsp;</div>
		<div id="calendarEventPopup">
			<div id="calendarEventClose">&nbsp;</div>
			<div id="calendarEventDate">&nbsp;</div>
			<div id="calendarEvents"></div>
		</div>
		<div id="calendarContainer">
<?php
			echo "<h3>{$months[$month]} {$year}</h3>";
			echo "<table cellspacing='2px' cellpadding='0'>";  
				echo "<thead>";
					echo "<tr>";
						for($day=0; $day<7; $day++){
							echo "<th>{$days[$day]}</th>";
						}
					echo "</tr>";
				echo "</thead>";
				echo "<tbody data-month-name='{$months[$month]}'>";
					echo "<tr>";
						$weekDay = date('N', mktime(0, 0, 0, $month, 1, $year));
						for($k=0; $k<$weekDay-1; $k++){ echo "<td class='dayEmpty'>&nbsp;</td>"; }
						$daysToNextRow = 7 - ($weekDay - 1);
						for($day=1; $day<=$countDaysInMonth; $day++){
							$daysToNextRow--;
							if($daysToNextRow < 0){
								echo "</tr><tr>";
								$daysToNextRow = 6;
							};
							echo "<td data-day='{$day}' data-month='{$month}' data-year='{$year}' class='day";
							if($day == $currentDay && $month == $currentMonth && $year == $currentYear){
								echo " currentDay";
							}
							echo "'>";
								echo "<div class='dayNumber'>{$day}</div>";
								echo "<div class='dayEvents'>";
									$count = 0;
									if(array_key_exists(6 - $daysToNextRow, $esempi['programmati'])){
										$count = stampaEventi(6 - $daysToNextRow, $esempi['programmati'], 2);
									}
									if(array_key_exists($day, $esempi)){
										stampaEventi($day, $esempi, 2, $count);
									}
								echo "</div>";
							echo "</td>";
						}
						for($k=0; $k<$daysToNextRow; $k++){ echo "<td class='dayEmpty'>&nbsp;</td>"; }
					echo "</tr>";
				echo "</tbody>"; 
			echo "</table>";
			
			function stampaEventi($day, $events, $limit = 2, $startOffset = 0){
				$exit = false;
				$count = $startOffset;
				if($limit > 0 && $limit >= $count){
					foreach($events[$day] as $oraInizio => $events){
						if($count >= $limit){
							echo "...";
							break;
						}
						foreach($events as $index => $event){
							if($count >= $limit){
								break;
							}
							echo $oraInizio . " ";
							//echo $events['id'] . " ";
							echo strtolower($event['comandoNome']) . "<br />";
							$count++;
						}
					}
				}
				return ($count);
			}
?>
		</div>
<?php @include('shared/footer.php'); ?>