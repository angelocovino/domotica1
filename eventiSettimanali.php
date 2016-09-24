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
    $programmati = $db->getEventsWithParams($month, $year);
    $programmati = $programmati['programmati'];
?>
<table>
    <?php
        /*
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
        */
    ?>
</table>
<?php @include('shared/footer.php'); ?>