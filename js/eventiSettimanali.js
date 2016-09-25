var ports = [];

loadXMLcallback = function (port, portArray){}

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
    var str;
    str = "<form id='addEvent' action='eventManagement.php' method='post' name='addEvent'>";
        str += "<table cellspacing='4px' cellpadding='0'>";
        var d, dow;
        dow = day;
        if(dow == 0){dow = 6;}
        else{dow--;}
        dow += 1;
        if(dow in events){
            str += calendarEventPrintScheduled(events[dow]);
        }else{
            str += "</table>";
            str += "<div class='center'>Non ci sono eventi programmati per questo giorno della settimana</div>";
            str += "<table cellspacing='4px' cellpadding='0'>";
        }
        str += calendarEventAddPrint(day);
        str += "</table>";
    str += "</table>";
    str += "</form>";
    return str;
}
function calendarEventPrintScheduled(eventArray){
    var startTime, evento, str = "";
    for(startTime in eventArray) {
        for(evento in eventArray[startTime]){
            str += "<tr>";
                str += "<td>";
                    str += startTime;
                str += "</td>";
                str += "<td data-id='" + eventArray[startTime][evento]["id"] + "'>";
                    str += eventArray[startTime][evento]["comandoNome"];
                str += "</td>";
            str += "</tr>";
        }
    }
    return (str);
}
function calendarEventAddPrint(day){
    var str;
    str = "<tr id='eventAddRowButton'>";
        str += "<td class='noBorder' colspan='2'>";
            str += "<input type='button' value='Aggiungi' />";
        str += "</td>";
    str += "</tr>";
    str += "<tr id='eventAddRow'>";
        str += "<td>";
            str += "<input class='eventAddTime' name='eventHour' type='number' min='0' max='23' value='0' />";
            str += ":";
            str += "<input class='eventAddTime' name='eventMinute' type='number' min='0' max='59' value='0' />";
        str += "</td>";
        str += "<td>";
            str += calendarEventGetCommands();
        str += "</td>";
    str += "</tr>";
    str += "<tr id='eventAddRowSubmit'>";
        str += "<td class='noBorder' colspan='2'>";
                str += "<input type='hidden' name='eventType' value='0' />";
                str += "<input type='submit' value='Salva' />";
        str += "</td>";
    str += "</tr>";
    return (str);
}
function calendarEventGetCommands(){
    var comando;
    var str = "<select name='eventCommand' id='eventCommand'>";
    for(comando in comandi){
        comando = comandi[comando];
        str += "<option value='" + comando['id'] + "'>" + comando['nome'] + "</option>";
    }
    str += "</select>";
    return (str);
}

$(document).ready(function(){
    var tdDeleteOldValue = [];
    var days = [
		'Lunedi',
		'Martedi',
		'Mercoledi',
		'Giovedi',
		'Venerdi',
		'Sabato',
		'Domenica'
	];
    $(".day").click(function(e){
        if($("#calendarCells").is(":visible") && !$(this).find(".dayEvents").is(":visible")){
            $(this).find(".dayEvents").fadeIn(500);
        }else{
            if($("#calendarCells").is(":visible") && e.target.className == "dayNumber"){
                $(this).find(".dayEvents").fadeOut(500);
            }else{
                var td = $(this);
                var day = td.attr("data-day");
                calendarEventToggle(500, function(){
                    $("#calendarEventDate").html(days[day]);
                    $("#calendarEvents").html(calendarEventsGet(day));
                });
            }
        }
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
    $("body").on("mouseover", "#calendarEvents tr:not(.scheduledEvent):not(#eventAddRow) td:last-child:not(.noBorder)", function (){
        tdDeleteOldValue[$(this).attr("data-id")] = $(this).html();
        $(this).fadeOut(250, function(){
            $(this).addClass("removable");
            $(this).html("ELIMINA");
            $(this).css("color", "red");
            $(this).css("cursor", "pointer");
            $(this).fadeIn(250);
        });
    });
    $("body").on("mouseout", "#calendarEvents tr:not(.scheduledEvent):not(#eventAddRow) td:last-child:not(.noBorder)", function (){
        $(this).fadeOut(250, function(){
            $(this).removeClass("removable");
            $(this).html(tdDeleteOldValue[$(this).attr("data-id")]);
            $(this).css("color", "black");
            $(this).css("cursor", "default");
            $(this).fadeIn(250);
        });
    });
    $("body").on("click", ".removable", function (){
        if(confirm("Sicuro di voler eliminare questo evento?")){
            var idEvento = $(this).attr("data-id");
            $.ajax({
                dataType: "json",
                type: "post",
                url: "eventManagement.php",
                data: {id: idEvento, eventType: 3}
            })
            .done(function(el){
                console.log("eliminato");
                window.location.href = window.location.href;
            })
            .error(function(obj,ErrorStr){
                console.log("errore eliminazione");
                console.log(obj);
            });
        }
    });
    $("#scheduledEventsButton").click(function(){
        document.location = 'eventiSettimanali.php';
    });
});