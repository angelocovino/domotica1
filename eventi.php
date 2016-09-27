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

    $db = dbmanagment::open();
    $esempi = $db->getEventsWithParams($month, $year);
    $comandi = $db->getComando();
	
/*
    $db->addEvents(10,10,19,9,2016,8);
     $db->addEvents(11,10,19,9,2016,8);
     $db->addEvents(12,10,19,9,2016,8);
     $db->addEvents(10,10,20,9,2016,8);
     $db->addEvents(10,10,20,9,2016,8);
    
    $db->addEventsScheduled(12,30,"1,2,4",8);
    $db->addEventsScheduled(12,30,"2,3,4",8);
    $db->addEventsScheduled(12,30,"1,2,4",2);
*/
    
	$countDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
?>
		<script>
<?php
    echo "var events=" . json_encode($esempi) . ";";
    echo "var comandi=" . json_encode($comandi) . ";";
    echo "var currentMonth=" . $currentMonth . ";";
    echo "var currentYear=" . $currentYear . ";";
    echo "var month=" . $month . ";";
    echo "var year=" . $year . ";";

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
                echo "<span id='prevMonth'>&lt;&lt;</span> ";
                echo "{$months[$month]} {$year}";
                echo " <span id='nextMonth'>&gt;&gt;</span>";
            echo "</h3>";
			echo "<table cellspacing='6px' cellpadding='0' id='calendarTable'>";  
				echo "<thead>";
					echo "<tr>";
						for($day=0; $day<7; $day++){
							echo "<th>{$days[$day]}</th>";
						}
					echo "</tr>";
				echo "</thead>";
				echo "<tbody data-month='{$month}' data-year='{$year}' data-month-name='{$months[$month]}'>";
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
							echo "<td data-day='{$day}' class='day";
							if($day == $currentDay && $month == $currentMonth && $year == $currentYear){
								echo " currentDay";
							}
							echo "'>";
								echo "<div class='dayNumber'>{$day}</div>";
								echo "<div class='dayEvents'>";
									$count = 0;
                                    $exit = false;
									if(array_key_exists(6 - $daysToNextRow, $esempi['programmati'])){
										$temp = stampaEventi(6 - $daysToNextRow, $esempi['programmati'], 2);
                                        $count = $temp['count'];
                                        $exit = $temp['exit'];
									}
									if(array_key_exists($day, $esempi)){
										stampaEventi($day, $esempi, 2, $count, $exit);
									}
								echo "</div>";
							echo "</td>";
						}
						for($k=0; $k<$daysToNextRow; $k++){ echo "<td class='dayEmpty'>&nbsp;</td>"; }
					echo "</tr>";
				echo "</tbody>"; 
			echo "</table>";
			echo "<div id='calendarCells' data-month='{$month}' data-year='{$year}' data-month-name='{$months[$month]}'>";
/*
						for($day=0; $day<7; $day++){
							echo "<th>{$days[$day]}</th>";
						}
*/
//echo "<tbody data-month-name='{$months[$month]}'>";
//for($k=0; $k<$weekDay-1; $k++){ echo "<td class='dayEmpty'>&nbsp;</td>"; }
						$weekDay = date('N', mktime(0, 0, 0, $month, 1, $year));
						$daysToNextRow = 7 - ($weekDay - 1);
						for($day=1; $day<=$countDaysInMonth; $day++){
							$daysToNextRow--;
							if($daysToNextRow < 0){
//echo "</tr><tr>";
								$daysToNextRow = 6;
							};
                            echo "<div data-day='{$day}' class='day'>";
								echo "<div class='dayNumber'>{$days[6 - $daysToNextRow]} {$day}</div>";
								echo "<div class='dayEvents'>";
                                $count = 0;
                                $exit = false;
                                if(array_key_exists(6 - $daysToNextRow, $esempi['programmati'])){
                                    $temp = stampaEventi(6 - $daysToNextRow, $esempi['programmati'], 2);
                                    $count = $temp['count'];
                                    $exit = $temp['exit'];
                                }
                                if(array_key_exists($day, $esempi)){
                                    stampaEventi($day, $esempi, 2, $count, $exit);
                                }else{
                                    echo "Nessun evento presente";
                                }
                                echo "</div>";
                            echo "</div>";
/*
							echo "<td data-day='{$day}' data-month='{$month}' data-year='{$year}' class='day";
							if($day == $currentDay && $month == $currentMonth && $year == $currentYear){
								echo " currentDay";
							}
							echo "'>";
								echo "<div class='dayNumber'>{$day}</div>";
								echo "<div class='dayEvents'>";
									$count = 0;
                                    $exit = false;
									if(array_key_exists(6 - $daysToNextRow, $esempi['programmati'])){
										$temp = stampaEventi(6 - $daysToNextRow, $esempi['programmati'], 2);
                                        $count = $temp['count'];
                                        $exit = $temp['exit'];
									}
									if(array_key_exists($day, $esempi)){
										stampaEventi($day, $esempi, 2, $count, $exit);
									}
								echo "</div>";
							echo "</td>";
*/
						}
//for($k=0; $k<$daysToNextRow; $k++){ echo "<td class='dayEmpty'>&nbsp;</td>"; }
			echo "</div>";
			echo "<h3>";
            	echo "<div id='scheduledEventsButton'>gestione eventi settimanali</div>";
            echo "</h3>";
?>
		</div>
<?php @include('shared/footer.php'); ?>