function loadXMLStatus(){
    $.ajax({
        dataType: "json",
        type: "get",
        url: "io/leggi.php"
    })
    .done(function(el){
        var on = "immagini/switchOn.svg";
        var off = "immagini/switchOff.svg";
        $.each(el, function(port, portArray){
            $.each(this, function(tagName, value) {
                
                if(port == 91 && tagName == 'led8'){//Leggo se acceso caldo
                    stato = "Spento";
                    if(value == "1") stato = "Acceso"
                    $("#Caldo #stato").html(stato);
                }
                if(port == 93 && tagName == 'led8'){//Leggo se acceso freddo
                    stato = "Spento";
                    if(value == "1") stato = "Acceso"
                    $("#Freddo #stato").html(stato);
                }                
                if(port == 91 && tagName == 'temp'){//Leggo temperatura sensore caldo
                    $("#Caldo #Temperatura").html(value);
                }
                if(port == 93 && tagName == 'temp'){//Leggo temperatura sensore freddo
                    $("#Freddo #Temperatura").html(value);
                }
                if(port == 91 && tagName == 'soglia'){//Leggo temperatura soglia
                    $("#Caldo #Soglia").html(value);
                }
                if(port == 93 && tagName == 'soglia'){//Leggo temperatura soglia
                    $("#Freddo #Soglia").html(value);
                }
                if(port == 91 && tagName == 'allC'){//Leggo manuale attivo caldo
                    stato = off;
                    if(value == "1")  stato = on;
                    $("#Caldo #manuale").attr('src',stato);
                }
                if(port == 93 && tagName == 'allC'){//Leggo manuale attivo freddo
                    stato = off;
                    if(value == "1")  stato = on;
                    $("#Freddo #manuale").attr('src',stato);
                }
                if(port == 91 && tagName == 'ReleTemp'){//Leggo automatico attivo caldo
                    stato = off;
                    if(value == "1")  stato = on;
                    $("#Caldo #automatico").attr('src',stato);
                }
                if(port == 93 && tagName == 'ReleTemp'){//Leggo automatico attivo freddo
                    stato = off;
                    if(value == "1")  stato = on;
                    $("#Freddo #automatico").attr('src',stato);
                }
            });
        });
        setTimeout(loadXMLStatus(),100);
    })
    .error(function(){
        console.log("Errore di connessione");
        setTimeout(loadXMLStatus(),500);
    });
}


$(document).ready(function(){
    loadXMLStatus();
});