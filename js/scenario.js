var ports = [91];


loadXMLcallback = function (port, portArray){
    if(portArray['allX']==0){
        $("#X").css("box-shadow","0 0 1px 1px darkgray");
    }else{
        $("#X").css("box-shadow","0 0 2px 2px yellow");
    }
    if(portArray['allY']==0){
        $("#Y").css("box-shadow","0 0 1px 1px darkgray");
    }else{
        $("#Y").css("box-shadow","0 0 2px 2px yellow");
    }
    if(portArray['allZ']==0){
        $("#Z").css("box-shadow","0 0 1px 1px darkgray");
    }else{
        $("#Z").css("box-shadow","0 0 2px 2px yellow");
    }
    if(portArray['all1']==0){
        $("#1").css("box-shadow","0 0 1px 1px darkgray");
    }else{
        $("#1").css("box-shadow","0 0 2px 2px yellow");
    }
    if(portArray['all2']==0){
        $("#2").css("box-shadow","0 0 1px 1px darkgray");
    }else{
        $("#2").css("box-shadow","0 0 2px 2px yellow");
    }
    if(portArray['allU']==0){
        $("#U").css("box-shadow","0 0 1px 1px darkgray");
    }else{
        $("#U").css("box-shadow","0 0 2px 2px yellow");
    }
    if(portArray['allW']==0){
        $("#W").css("box-shadow","0 0 1px 1px darkgray");
    }else{
        $("#W").css("box-shadow","0 0 2px 2px yellow");
    }
    if(portArray['allL']==0){
        $("#L").css("box-shadow","0 0 1px 1px darkgray");
    }else{
        $("#L").css("box-shadow","0 0 2px 2px yellow");
    }
    if(portArray['allV']==0){
        $("#V").css("box-shadow","0 0 1px 1px darkgray");
    }else{
        $("#V").css("box-shadow","0 0 2px 2px yellow");
    }

}
