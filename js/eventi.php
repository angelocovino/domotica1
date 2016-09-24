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
    var eventTime, str;
    str = "<form id='addEvent' action='eventManagement.php' method='post' name='addEvent'>";
        str += "<table cellspacing='4px' cellpadding='0'>";
        var d, dow;
        d = new Date(currentYear, currentMonth - 1, day, 0, 0, 0, 0);
        dow = d.getDay();
        if(dow == 0){dow = 6;}
        else{dow--;}
        if(dow in events["programmati"]){
            str += calendarEventPrintScheduled(events["programmati"][dow]);
        }
        if(day in events){
            for(eventTime in events[day]) {
                str += calendarEventPrint(events[day][eventTime], eventTime);
            }
        }else{
            str += "</table>";
            str += "<div class='center'>Non ci sono eventi programmati per questo giorno</div>";
            str += "<table cellspacing='4px' cellpadding='0'>";
        }
        str += calendarEventAddPrint(day);
        str += "</table>";
    str += "</table>";
    str += "</form>";
    return str;
}
function calendarEventPrint(eventArray, startTime){
    var str = "";
    for(evento in eventArray) {
        str += "<tr>";
            str += "<td>";
                str += startTime;
            str += "</td>";
            str += "<td data-id='" + eventArray[evento]["id"] + "'>";
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
            str += "<tr class='scheduledEvent'>";
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
                str += "<input type='hidden' name='eventDay' value='" + day + "' />";
                str += "<input type='hidden' name='eventMonth' value='" + month + "' />";
                str += "<input type='hidden' name='eventYear' value='" + year + "' />";
                str += "<input type='hidden' name='evetnType' value='0' />";
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
    $(".day").click(function(e){
        if($("#calendarCells").is(":visible") && !$(this).find(".dayEvents").is(":visible")){
            $(this).find(".dayEvents").fadeIn(500);
        }else{
            if($("#calendarCells").is(":visible") && e.target.className == "dayNumber"){
                $(this).find(".dayEvents").fadeOut(500);
            }else{
                var td = $(this);
                var day = td.attr("data-day");
                var month, monthName, year;
                month = td.parents("tbody").attr("data-month");
                if(month != undefined){
                    monthName = td.parents("tbody").attr("data-month-name");
                    year = td.parents("tbody").attr("data-year");
                }else{
                    month = $("#calendarCells").attr("data-month");
                    monthName = $("#calendarCells").attr("data-month-name");
                    year = $("#calendarCells").attr("data-year");
                }
                calendarEventToggle(500, function(){
                    //$("#calendarEventDate").html(pad(day, 2) + "/" + pad(month, 2) + "/" + year);
                    $("#calendarEventDate").html(day + " " + monthName + " " + year);
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
                data: {id: idEvento, eventType: 2}
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