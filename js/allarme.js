var ports = [93];
var load = 0;
var statoAllarmeT = 0;
var statoAllarmeP = 0;

loadXMLcallback = function (port, portArray){
    contdebug = portArray["Cntdebug"];
    statoAllarmeT = portArray['allT'];
    statoAllarmeP = portArray['allP'];
    var stato = $("#statoAllarme");
    if((portArray['allT'] >= "1") && (portArray['Cntdebug'] == "0")){//Allarme attivo totale
        stato.html("Attivo totale");
        $("#loadBar").hide();
    }else if((portArray['allP'] >= "1") && (portArray['Cntdebug'] == "0")){//Allarme attivo parziale
        stato.html("Attivo parziale");
        $("#loadBar").hide();
    }else if((portArray['led11'] == '0' ) && (portArray["Cntdebug"] == "0")){//Allarme pronto
        stato.html("Pronto");
        $("#loadBar").hide();
    }else if( ((portArray['allT'] == "2") || (portArray['allP'] == "2")) && (portArray["Cntdebug"] == "0")){
        stato.html("Errore");
        $("#loadBar").hide();
    }else{//Allarme in attivazione
        if(load == 0){
            if(portArray['allT'] == "2")stato.html("Attivazione allarme totate in corso ");
            if(portArray['allP'] == "2")stato.html("Attivazione allarme parziale in corso ");
            $("#loadBar").attr("max",portArray['DurataRele14']);
            $("#loadBar").show();
            loadingBar();
            load = 1;
        }
    }

}

function loadingBar(){
    loadBar = document.getElementById("loadBar");
    loadBar.value ++;
    if((loadBar.value<60) && ((statoAllarmeT==2) || (statoAllarmeP ==2))){
        setTimeout(loadingBar, 1000);    
    }else{
        load = 0;
        loadBar = document.getElementById("loadBar").value = 0;
        $("#loadBar").hide();
    }
}