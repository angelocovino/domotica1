<?php
    include("include/dbmanagement.php");
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
	
	$countDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	



	$months = array(
		1=>'Gennaio',
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
	$comandi = array(
		1 => array(
			"id" => 30,
			"nome" => "caldaia esplode"
		),
		2 => array(
			"id" => 30,
			"nome" => "caldaia riparata"
		),
		3 => array(
			"id" => 30,
			"nome" => "caldaia distrutta"
		),
		4 => array(
			"id" => 54,
			"nome" => "specchio bevuto"
		)
	);
?>
<html>
    <head>
        <title>Domotica Varricchio</title>
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="css/main.css" type="text/css" >
		<style>
			* {
				margin: 0;
				padding: 0;
			}
			html,
			body {
				position: relative;
				height: 100%;
				width: 100%;
			}
			#calendarContainer {
			}
			#calendarContainer h3 {
				display: inline-block;
				width: 100%;
				text-align: center;
				font-size: 2em;
				margin: 10px 0;
			}
			#calendarContainer table {
				width: 100%;
				background-color: #006062;
			}
			#calendarContainer td,
			#calendarContainer th {
				text-align: center;
				width: 14%;
			}
			#calendarContainer th {
				height: 30px;
				font-size: 16px;
				color: black;
				background-color: lightgray;
			}
			#calendarContainer td {
				background-color: white;
				height: 100px;
			}
			#calendarContainer .day {
				position: relative;
				padding: 0 5px;
				padding-top: 30px;
				vertical-align: top;
				text-align: left;
			}
			#calendarContainer .dayEmpty {
				background-color: transparent;
				/*background-color: gray;*/
			}
			#calendarContainer .currentDay {
				background-color: #eee;
			}
			#calendarContainer .day .dayNumber{
				position: absolute;
				top: 5px;
				left: 5px;
			}
			#calendarContainer .day:not(.currentDay) .dayNumber {
				font-size: 1.2em;
			}
			#calendarContainer .currentDay .dayNumber {
				font-size: 1.5em;
				color: darkred;
			}
			
			#calendarEventPopup {
				position: fixed;
				z-index: 100;
				top: calc(50% - 150px);
				left: calc(50% - 200px);
				width: 400px;
				padding: 10px;
				background-color: white;
				border: 0px solid black;
				display: none;
				border-radius: 20px;
				-webkit-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
				-moz-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
				-o-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
				box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
			}
			#calendarEventClose {
				position: absolute;
				content: '';
				right: 13px;
				top: 13px;
				z-index: 101;
				width: 20px;
				height: 20px;
				background: url('close.png') transparent center center no-repeat;
				background-size: 20px 20px;
				cursor: pointer;
			}
			#calendarEventDate {
				font-size: 1.5em;
				text-align: center;
				padding-bottom:10px;
			}
			#calendarEvents {
			}
			#calendarEvents table{
				width: 100%;
			}
			#calendarEvents table td{
				padding: 5px 10px;
				font-size: 1.1em;
			}
			#calendarEvents table td:not(.noBorder){
				border-bottom: 1px solid gray;
			}
			#calendarEvents table td:not(.noBorder):first-child{
				border-right: 1px solid gray;
				width: 25%;
				text-align: center;
			}
			#calendarEvents table td:last-child{
				
			}
			#calendarEvents .eventAddTime{
				width: 35px;
				text-align: center;
				border: 1px solid lightgray;
				border-radius: 5px;
			}
			#popupBackground{
				position: fixed;
				z-index: 99;
				width: 100%;
				height: 100%;
				background-color: rgba(0, 0, 0, 0.6);
				display: none;
			}
			#eventAddRow {
				display: none;
			}
			#eventCommand {
				width: 100%;
			}
			#eventAddRowButton input,
			#eventAddRowSubmit input {
				width: 100%;
				font-size: 1em;
				padding: 5px;
				text-transform: uppercase;
			}
			#eventAddRowSubmit {
				display: none;
			}
			div.center {
				text-align: center;
			}
		</style>
    </head>
    <body>
		<script>
			<?php
				echo "var events=" . json_encode($esempi) . ";";
				echo "var comandi=" . json_encode($comandi) . ";";
				echo "var currentMonth=" . $currentMonth . ";";
				echo "var currentYear=" . $currentYear . ";";
			?>
			function pad(str, n){
				if(str.length < n){
					return ("0" + pad(str, n-1));
				}
				return str;
			}
			function isFunction(functionToCheck) {
				var getType = {};
				return (functionToCheck && getType.toString.call(functionToCheck) === '[object Function]');
			}
			function isCalendarEventOpen(){
				return ($("#calendarEventPopup").is(":visible"));
			}
			function calendarEventToggle(time = 500, callback = null){
				if(isCalendarEventOpen()){
					calendarEventClose(time, callback);
					if(isFunction(callback)){
						callback();
						calendarEventOpen(time);
					}
				}else{
					callback();
					calendarEventOpen(time);
				}
			}
			function calendarEventOpen(time = 500){
				$("#popupBackground").fadeIn(time);
				$("#calendarEventPopup").fadeIn(time);
			}
			function calendarEventClose(time = 500, callback = null){
				$("#popupBackground").fadeOut(time, function(){
					if(isFunction(callback)){
						callback();
					}
				});
				$("#calendarEventPopup").fadeOut(time);
			}
			function calendarEventsGet(day){
				var eventTime, str = "<table cellspacing='4px' cellpadding='0'>";
				var d, dow;
				d = new Date(currentYear, currentMonth - 1, day, 0, 0, 0, 0);
				dow = d.getDay();
				if(dow == 0){dow = 6;}
				else{dow--;}
				/*
				console.log(dow);
				console.log(events);
				console.log("poi");
				*/
				if(dow in events["programmati"]){
					str += calendarEventPrintScheduled(events["programmati"][dow]);
				}
				if(day in events){
					for(eventTime in events[day]) {
						str += calendarEventPrint(events[day][eventTime], eventTime);
					}
				}else{
					str += "<div class='center'>Non ci sono eventi programmati per questo giorno</div>";
				}
				str += calendarEventAddPrint();
				str += "</table>";
				return str;
			}
			function calendarEventPrint(eventArray, startTime){
				var str = "";
				for(evento in eventArray) {
					str += "<tr>";
						str += "<td>";
							str += startTime;
						str += "</td>";
						str += "<td>";
							str += eventArray[evento]["comandoNome"];
						str += "</td>";
					str += "</tr>";
				}
				return (str);
			}
			function calendarEventPrintScheduled(eventArray){
				var startTime, evento, str = "";
				for(startTime in eventArray) {
					for(evento in eventArray[startTime]){
						str += "<tr>";
							str += "<td>";
								str += startTime;
							str += "</td>";
							str += "<td>";
								str += eventArray[startTime][evento]["comandoNome"];
							str += "</td>";
						str += "</tr>";
					}
				}
				return (str);
			}
			function calendarEventAddPrint(){
				var str = "<tr id='eventAddRowButton'>";
					str += "<td class='noBorder' colspan='2'>";
						str += "<input type='button' value='Aggiungi' />";
					str += "</td>";
				str += "</tr>";
				str += "<tr id='eventAddRow'>";
					str += "<td>";
						str += "<input class='eventAddTime' type='number' min='0' max='23' value='0' />";
						str += ":";
						str += "<input class='eventAddTime' type='number' min='0' max='59' value='0' />";
					str += "</td>";
					str += "<td>";
						str += calendarEventGetCommands();
					str += "</td>";
				str += "</tr>";
				str += "<tr id='eventAddRowSubmit'>";
					str += "<td class='noBorder' colspan='2'>";
						str += "<input type='button' value='Salva' />";
					str += "</td>";
				str += "</tr>";
				return (str);
			}
			function calendarEventGetCommands(){
				var comando;
				var str = "<select id='eventCommand'>";
				for(comando in comandi){
					comando = comandi[comando];
					str += "<option value='" + comando['id'] + "'>" + comando['nome'] + "</option>";
				}
				str += "</select>";
				return (str);
			}
			$(document).ready(function(){
				$(".day").click(function(){
					var td = $(this);
					var day = td.attr("data-day");
					var month = td.attr("data-month");
					var monthName = td.parents("tbody").attr("data-month-name");
					var year = td.attr("data-year");
					calendarEventToggle(500, function(){
						//$("#calendarEventDate").html(pad(day, 2) + "/" + pad(month, 2) + "/" + year);
						$("#calendarEventDate").html(day + " " + monthName + " " + year);
						$("#calendarEvents").html(calendarEventsGet(day));
					});
				});
				$("#calendarEventClose").click(function(){
					calendarEventToggle(500);
				});
				$("body").on("click", "#eventAddRowButton input", function(){
					$("#eventAddRowButton").fadeOut(500, function(){
						$("#eventAddRow").fadeIn(500);
						$("#eventAddRowSubmit").fadeIn(500);
					});
				});
			});
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
	</body>
</html>