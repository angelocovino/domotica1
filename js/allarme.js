var ports = [93];
var load = 0;
var statoAllarmeT = 0;
var statoAllarmeP = 0;
var stato = $("#statoAllarme");


loadXMLcallback = function (port, portArray){
    contdebug = portArray["Cntdebug"];
    statoAllarmeT = portArray['allT'];
    statoAllarmeP = portArray['allP'];
    
    if(portArray['allR']=="1"){
        $(".reset").show();
    }else{
        $(".reset").hide();
    }
    
    if(portArray['led16']=="0"){
        $(".sirena").attr("src","immagini/sirengreen.svg");
    }else{
        $(".sirena").attr("src","immagini/siren.svg");
    }
    
    if(portArray['allE']=="2"){
        $(".riciclo .attivo").css("background-color","#00d0ff");
        $(".riciclo .parziale").css("background-color","#fff");
        $(".riciclo .disattivo").css("background-color","#fff");
    }else if(portArray['allE']=="1"){
        $(".riciclo .attivo").css("background-color","#fff");
        $(".riciclo .parziale").css("background-color","#00d0ff");
        $(".riciclo .disattivo").css("background-color","#fff");
    }else{
        $(".riciclo .attivo").css("background-color","#fff");
        $(".riciclo .parziale").css("background-color","#fff");
        $(".riciclo .disattivo").css("background-color","#00d0ff");
    }
    
    
    
    if((portArray['allT'] >= "1") && (portArray['Cntdebug'] == "0")){//Allarme attivo totale
        if(portArray['allT'] == "2"){
            stato.html("Allarme totale attivo con attenzione");
        }else{
            stato.html("Allarme totale attivo");
        }
        $("#loadBar").hide();
    }else if((portArray['allP'] >= "1") && (portArray['Cntdebug'] == "0")){//Allarme attivo parziale
        if(portArray['allP'] == "2"){
            stato.html("Allarme parziale attivo con attenzione");
        }else{
            stato.html("Allarme parziale attivo");
        }
        $("#loadBar").hide();
    }else if((portArray['led11'] == '0' ) && (portArray["Cntdebug"] == "0")){//Allarme pronto
        stato.html("Pronto");
        load=0;
        $("#loadBar").hide();
    }else if(portArray["Cntdebug"]>0){//Allarme in attivazione
        if(load == 0){
            loadBar = document.getElementById("loadBar").value = 0;
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
    if(loadBar.value<61){
        if((!((statoAllarmeT==2) || (statoAllarmeP ==2))) && (contdebug > 0)){
            stato.html("Allarme disattivato, attendere la fine della procedura di attivazione");
        }
        setTimeout(loadingBar, 1000);    
    }else{
        load = 0;
        loadBar = document.getElementById("loadBar").value = 0;
        $("#loadBar").hide();
    }
}