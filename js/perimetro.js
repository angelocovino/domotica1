var ports = [];
loadXMLcallback = function (port, portArray){
    return (false);
}
function vaiA (pagina){
    document.location = pagina + '.php';
}
/*
var startDrawingOffsetTL = new Punto(50, 50);
var nomeFontFamily = 'Arial';
var nomeFontSize = '100';
var nomeColor = 'blue';

function Punto(x, y){
    this.x = x;
    this.y = y;
    this.calcolaDestinazione = function (length, direzione){
        return new Punto(this.x + (length * Math.sin((90 - direzione) * (Math.PI / 180.0))), this.y - (length * Math.sin(direzione * (Math.PI / 180.0))));
    }
}
function Stanza (svg, nome, startX, startY, width, height) {
    this.svg = svg;
    this.nome = nome;
    this.startX = startX;
    this.startY = startY;
    this.width = width;
    this.height = height;
    this.endX = this.startX + this.width;
    this.endY = this.startY + this.height;
    this.draw = function(gruppo, nomeVisibile) {
        this.svg.rect(gruppo, this.startX, this.startY, this.width, this.height, 0, 0, {fill:'#ffffff', stroke:'green', strokeWidth: 1});
        if(nomeVisibile){
            //this.nomeSvg = this.svg.text(gruppo, this.startX, this.startY, this.nome, {fontFamily: nomeFontFamily, fontSize: nomeFontSize, fill: nomeColor});
            this.nomeSvg = this.svg.text(gruppo, this.startX, this.startY, this.nome, {fontFamily: nomeFontFamily, fontSize: nomeFontSize, fill: nomeColor, dy: -30});
            var x = $(this.nomeSvg).width();
            var y = $(this.nomeSvg).height();
            x = (this.width/2) - (x/2);
            y = ((this.height + y) /2) - (y/2);

            $(this.nomeSvg).attr("x", this.startX + x );
            $(this.nomeSvg).attr("y", this.startY + y );

            //pippo.remove();
            //pippo = svg.text(gruppo, this.startX + x , this.startY, 'matri', {fontFamily: 'Arial', fontSize: '100', fill: 'blue'});
        }
        return this;
    };
}
function Muro(stanza, corner, offsetX, offsetY, direction, length) {
    this.stanza = stanza;
    this.corner = corner;
    this.offsetX = offsetX;
    this.offsetY = offsetY;
    this.direction = direction;
    this.length = length;
    this.svg = this.stanza.svg;

    this.start = new Punto(this.offsetX, this.offsetY);
    switch(corner[0]){
        case "t":
            this.start.y += this.stanza.startY;
            break;
        case "b":
            this.start.y += this.stanza.endY;
            break;
    }
    switch(corner[1]){
        case "l":
            this.start.x += this.stanza.startX;
            break;
        case "r":
            this.start.x += this.stanza.endX;
            break;
    }
    this.end = this.start.calcolaDestinazione(this.length, this.direction);

    this.draw = function(gruppo) {
        //this.svg.line(gruppo, this.start.x, this.start.y, this.end.x, this.end.y, {stroke:'red', strokeWidth: 1});
        this.svg.line(gruppo, this.start.x, this.start.y, this.end.x, this.end.y, {stroke:'red', strokeWidth: 1});
        return this;
    };
}
function MuroContinuo(muro, direction, length){
    muroContinuo = jQuery.extend({}, muro);
    //muroContinuo = muro.prototype.clone();
    muroContinuo.direction = direction;
    muroContinuo.length = length
    muroContinuo.start.x = muro.end.x;
    muroContinuo.start.y = muro.end.y;
    muroContinuo.end = muroContinuo.start.calcolaDestinazione(length, direction);
    return muroContinuo;
}

*/

/*  
$(document).ready(function() {
    var svg = $('#svgload').svg().svg('get');
    
    //([0-9]*\.\d\,[0-9]*\.\d)\s
    


    
    
    

    
    svg.polygon([[574.7,31.4],[574.7,788.3],[564.7,788.3],[564.7,841.4],  
    [574.7,841.4],[574.7,1504.3],[709.7,1504.3],[709.7,1455.4],
	[620.7,1455.4],[620.7,841.4],[831.6,841.4],[831.6,829.2],[626.6,829.2],[626.6,789.3],[626.6,788.4],[620.7,788.4],[620.7,628.4],[840.7,628.4],
	[840.7,616.4],[620.7,616.4],[620.7,74.5],[740.7,74.5],[740.7,46.8],[740.7,46.4],[755.7,46.4],[755.7,31.5]],  
                {fill: 'lime', stroke: 'blue', strokeWidth: 10});
 
    svg.polygon([    [890.4,31.4],[890.4,47.3],[904.8,47.3],[904.8,74.6],[1001.7,74.6],[1001.7,85.3],[1043.7,85.3],[1043.7,616.3],
	[943.6,616.3],[943.6,628.3],[1113.8,628.3],[1113.8,616.1],[1060.5,616.1],[1060.5,392.3],[1177.7,392.3],[1177.7,437.4],[1278.6,437.4],
	[1278.6,616.3],[1215.2,616.3],[1215.2,628.3],[1293.6,628.3],[1293.6,495.4],[1298.7,495.4],[1298.7,421.4],[1195.7,421.4],[1195.7,286.4],
	[1182.9,286.4],[1182.9,374.3],[1059.6,374.3],[1059.6,172.3],[1094.6,172.3],[1094.6,143.5],[1109.6,143.5],[1109.6,129.1],[1087.6,129.1],
	[1087.6,32.1]], {fill: 'lime', stroke: 'blue', strokeWidth: 10});
    
    matrimoniale = svg.polygon([[1042.4,86.4],[1042.4,615.1],[621.9,615.1],[621.9,75.6],[1000.6,75.6],[1000.6,86.4]], {fill: 'lime', stroke: 'blue', strokeWidth: 10});
    
    matrimoniale = svg.polygon([   [1191.7,128.3],[1302.4,128.3],[1302.4,141.3],[1290,141.3],[1290,160.5],[1282.7,160.5],[1282.7,199.5],
	[1217.7,199.5],[1217.7,172.4],[1206.6,172.4],[1206.6,143.2],[1191.7,143.2]], {fill: 'lime', stroke: 'blue', strokeWidth: 10});
    
         svg.polygon([[1434.6,35.3],[1434.6,128.4],[1405.7,128.4],[1405.7,140.5],[1417.7,140.5],[1417.7,162.3],[1477.7,162.3],
	[1477.7,483.4],[1391.7,483.4],[1391.7,495.4],[1416.4,495.4],[1416.4,505.6],[1428.8,505.6],[1428.8,495.6],[1491.7,495.6],[1491.7,77.7],
	[1601.7,77.7],[1601.7,50.2],[1606.7,50.2],[1606.7,35.2]],{fill: 'lime', stroke: 'blue', strokeWidth: 10});
    
     svg.polygon([[1737.6,35.1],[1737.6,50.4],[1750.6,50.4],[1750.6,78.3],[1862.4,78.3],[1862.4,616.1],[1429.6,616.1],[1429.6,606.4],[1417.3,606.4],[1417.3,628.4],[1786.6,628.4],[1786.6,638.5],[1810.8,638.5],[1810.8,628.5],[1911.7,628.5],[1911.7,35.1]],{fill: 'lime', stroke: 'blue', strokeWidth: 10});
    
    
     svg.polygon([[893.7,1459.3],[893.7,1507.9],[1069.7,1507.9],[1069.7,1459.3],[1001.5,1459.3],[1001.5,1448.2],[963.1,1448.2],
[963.1,845.3],[1021.6,845.3],[1021.6,832.7],[1013.8,832.7],[1013.8,792.4],[951.2,792.4],[951.2,833.1],[934.7,833.1],[934.7,844.9],[951.6,844.9] [951.6,1459.4]],{fill: 'lime', stroke: 'blue', strokeWidth: 10});
    
    
     svg.polygon([[1122.7,832.3],[1122.7,845.3],[1294.6,845.3],[1294.6,1459.4],[1253.1,1459.4],[1253.1,1508.3],[1430.8,1508.3],
	[1430.8,1458.8],[1363.7,1458.8],[1363.7,1448.2],[1324.2,1448.2],[1324.2,1458.8],[1306.4,1458.8],[1306.4,845.2],[1412.1,845.2],[1412.1,792.2],[1345.3,792.2],[1345.3,832.9]],{fill: 'lime', stroke: 'blue', strokeWidth: 10});
    
    
     svg.polygon([[1687.6,1459.4],[1687.6,1448.2],[1766.9,1448.2],[1766.9,1459.4],[1792.5,1459.4],[1792.5,1508],[1614.2,1508], 
	[1614.2,1459.5]],{fill: 'lime', stroke: 'blue', strokeWidth: 10});
    
    
     svg.polygon([[1990.7,1351.2],[2054.2,1351.2],[2054.2,1459.4],[2119.4,1459.4],[2119.4,1508],[1945.7,1508],[1945.7,1459.1],
	[1990.9,1459.1]],{fill: 'lime', stroke: 'blue', strokeWidth: 10});
    
    
     svg.polygon([[2310.6,1459.2],[2310.6,1507.4],[2352.2,1507.4],[2352.2,783.4],[1811.7,783.4],[1811.7,769.3],[1787.3,769.3],
	[1787.3,793.7],[1723.3,793.7],[1723.3,848.9],[1809.5,848.9],[1809.5,808.4],[2011.7,808.4],[2011.7,960.4],[2024.3,960.4],[2024.3,802], [2109.5,802],[2109.5,852.5],2242,852.5 [2328.4,948.4],[2328.4,1459.4]],{fill: 'lime', stroke: 'blue', strokeWidth: 10});
    
    
     svg.polygon([[1193.5,173.7],[1193.5,285.3],[1181.2,285.3],[1181.2,372.1],[1061,372.1],[1061,173.7]],{fill: 'lime', stroke: 'blue', strokeWidth: 10});

        
        
     svg.polygon([[1297.5,173.7],[1297.5,420.1],[1196.9,420.1],[1196.9,285.3],[1195.9,285.3],[1195.9,173.7],[1216.4,173.7],
	[1216.4,200.6],[1284,200.6],[1284,173.7 ]],{fill: 'lime', stroke: 'blue', strokeWidth: 10});
    
    
});
*/





/*


$(document).ready(function() {

}
    var svg = $('#svgload').svg().svg('get');

    var casa = svg.group({stroke: 'green'});
    /*
    var Balcone = svg.group({stroke: 'green'});
    svg.line(Balcone, quotaStartX + 14, quotaStartY , quotaStartX + 50, quotaStartY , {strokeWidth: 0.5}); 
    svg.line(Balcone, quotaStartX + 50, quotaStartY , quotaStartX + 50, quotaStartY + 8, {strokeWidth: 0.5}); 
    svg.line(Balcone, quotaStartX + 14, quotaStartY , quotaStartX + 14, quotaStartY + 8, {strokeWidth: 0.5}); 
    
    var matrimoniale = new Stanza(svg, "MATR", startDrawingOffsetTL.x, startDrawingOffsetTL.y, 346, 440);
    matrimoniale.draw(casa);

    var bagnoGrandeL = new Stanza(svg, "WC2L", matrimoniale.startX + 358, matrimoniale.startY + 77, 111, 165);
    bagnoGrandeL.draw(casa);

    var bagnoGrandeC = new Stanza(svg, "WC2C", bagnoGrandeL.startX + bagnoGrandeL.width, bagnoGrandeL.startY, 85, 204);
    bagnoGrandeC.draw(casa);

    var bagnoGrandeR = new Stanza(svg, "WC2R", bagnoGrandeC.startX + bagnoGrandeC.width, bagnoGrandeC.startY, 145, 260);
    bagnoGrandeR.draw(casa);

    var bagnoPiccoloL = new Stanza(svg, "WC1L", bagnoGrandeL.startX, bagnoGrandeL.startY + 180, 97, 182);
    bagnoPiccoloL.draw(casa);

    var bagnoPiccoloR = new Stanza(svg, "WC1R", bagnoPiccoloL.startX + bagnoPiccoloL.width, bagnoPiccoloL.startY + 37, 83, 145);
    bagnoPiccoloR.draw(casa);

    var tony = new Stanza(svg, "TONY", matrimoniale.startX + 710, matrimoniale.startY, 304, 440);
    tony.draw(casa);

    var tonyIngresso = new Stanza(svg, "TONY", tony.startX - 59, tony.startY + 340, 60, 100);
    tonyIngresso.draw(casa);

    var andrea = new Stanza(svg, "ANDREA", matrimoniale.startX, matrimoniale.startY + 627, 270, 502);
    andrea.draw(casa);

    var elisa = new Stanza(svg, "ELISA", andrea.startX + 280, andrea.startY, 270.5, 502);
    elisa.draw(casa);

    var salone = new Stanza(svg, "SALONE", elisa.startX + 280, elisa.startY - 30, 575, 502 + 30);
    salone.draw(casa);

    var cucina = new Stanza(svg, "CUCINA", salone.startX + 587, salone.startY - 5.5, 250, 538);
    cucina.draw(casa);

    // MURA PARTENDO DA SINISTRA IN ALTO, CONTIGUE
    var murosx = new Muro(matrimoniale, 'tl', -38, -38, 0, 148).draw(casa);
    var muro1 = MuroContinuo(murosx, 270, 12).draw(casa);
    var muro2 = MuroContinuo(muro1, 180, 12).draw(casa);
    var muro3 = MuroContinuo(muro2, 270, 23).draw(casa);
    var muro4 = MuroContinuo(muro3, 180, 98).draw(casa);
    var muro5 = MuroContinuo(muro4, 270, 443).draw(casa);
    var muro6 = MuroContinuo(muro5, 0, 179.5).draw(casa);
    var muro7 = MuroContinuo(muro6, 270, 10).draw(casa);
    var muro8 = MuroContinuo(muro7, 180, 179.5).draw(casa);
    var muro9 = MuroContinuo(muro8, 270, 131).draw(casa);
    var muro10 = MuroContinuo(muro9, 0, 5).draw(casa);
    var muro11 = MuroContinuo(muro10, 270, 33).draw(casa);
    var muro12 = MuroContinuo(muro11, 0, 167.5).draw(casa);
    var muro13 = MuroContinuo(muro12, 270, 10).draw(casa);
    var muro14 = MuroContinuo(muro13, 180, 172.5).draw(casa);
    var muro15 = MuroContinuo(muro14, 270, 502).draw(casa);
    var muro16 = MuroContinuo(muro15, 0, 73).draw(casa);
    var muro17 = MuroContinuo(muro16, 270, 40).draw(casa);
    var muro18 = MuroContinuo(muro17, 180, 111).draw(casa);
    var muro19 = MuroContinuo(muro18, 90, 542).draw(casa);
    var muro20 = MuroContinuo(muro19, 180, 8).draw(casa);
    var muro21 = MuroContinuo(muro20, 90, 43).draw(casa);
    var muro22 = MuroContinuo(muro21, 0, 8).draw(casa);
    var muro23 = MuroContinuo(muro22, 90, 619).draw(casa);

    // MURA PARTENDO DA SINISTRA-CENTRO IN ALTO, CONTIGUE
    var murocsx = new Muro(matrimoniale, 'tl', 232, -3, 0, 79).draw(casa);
    var muro24 = MuroContinuo(murocsx, 270, 9).draw(casa);
    var muro25 = MuroContinuo(muro24, 0, 35).draw(casa);
    var muro26 = MuroContinuo(muro25, 270, 434).draw(casa);
    var muro27 = MuroContinuo(muro26, 180, 82.5).draw(casa);
    var muro28 = MuroContinuo(muro27, 270, 10).draw(casa);
    var muro29 = MuroContinuo(muro28, 0, 139).draw(casa);
    var muro30 = MuroContinuo(muro29, 90, 10).draw(casa);
    var muro31 = MuroContinuo(muro30, 180, 43.5).draw(casa);
    var muro32 = MuroContinuo(muro31, 90, 183).draw(casa);
    var muro33 = MuroContinuo(muro32, 0, 96).draw(casa);
    var muro34 = MuroContinuo(muro33, 270, 37).draw(casa);
    var muro35 = MuroContinuo(muro34, 0, 83).draw(casa);
    var muro36 = MuroContinuo(muro35, 270, 146).draw(casa);
    var muro37 = MuroContinuo(muro36, 180, 52).draw(casa);
    var muro38 = MuroContinuo(muro37, 270, 10).draw(casa);
    var muro39 = MuroContinuo(muro38, 0, 64).draw(casa);
    var muro40 = MuroContinuo(muro39, 90, 109).draw(casa);
    var muro41 = MuroContinuo(muro40, 0, 4.5).draw(casa);
    var muro42 = MuroContinuo(muro41, 90, 10).draw(casa);
    var muro43 = MuroContinuo(muro42, 270, 1.6).draw(casa);
    var muro44 = MuroContinuo(muro43, 90, 52).draw(casa);
    var muro45 = MuroContinuo(muro44, 180, 85).draw(casa);
    var muro46 = MuroContinuo(muro45, 90, 110).draw(casa);
    var muro47 = MuroContinuo(muro46, 180, 10).draw(casa);
    var muro48 = MuroContinuo(muro47, 270, 72).draw(casa);
    var muro49 = MuroContinuo(muro48, 180, 101).draw(casa);
    var muro50 = MuroContinuo(muro49, 90, 166).draw(casa);
    var muro51 = MuroContinuo(muro50, 0, 29).draw(casa);
    var muro52 = MuroContinuo(muro51, 90, 23).draw(casa);
    var muro53 = MuroContinuo(muro52, 0, 12).draw(casa);
    var muro54 = MuroContinuo(muro53, 90, 12).draw(casa);
    var muro55 = MuroContinuo(muro54, 180, 18).draw(casa);
    var muro56 = MuroContinuo(muro55, 90, 79).draw(casa);
    var muro57 = MuroContinuo(muro56, 180, 161).draw(casa);
    var muro58 = MuroContinuo(muro57, 270, 12).draw(casa);
    var muro59 = MuroContinuo(muro58, 0, 12).draw(casa);
    var muro60 = MuroContinuo(muro59, 270, 23).draw(casa);

    // MURO DIVISORE BAGNOGRANDE-BALCONE
    var muroccx = new Muro(bagnoGrandeL, 'tl', 121, 0, 0, 9).draw(casa);
    var muro61 = MuroContinuo(muroccx, 270, 22).draw(casa);
    var muro62 = MuroContinuo(muro61, 0, 53).draw(casa);
    var muro63 = MuroContinuo(muro62, 90, 31.5).draw(casa);
    var muro64 = MuroContinuo(muro63, 0, 6).draw(casa);
    var muro65 = MuroContinuo(muro64, 90, 16).draw(casa);
    var muro66 = MuroContinuo(muro65, 0, 10).draw(casa);
    var muro67 = MuroContinuo(muro66, 90, 10).draw(casa);
    var muro68 = MuroContinuo(muro67, 180, 90).draw(casa);
    var muro69 = MuroContinuo(muro68, 270, 12).draw(casa);
    var muro70 = MuroContinuo(muro69, 0, 12).draw(casa);
    var muro71 = MuroContinuo(muro70, 270, 23).draw(casa);


    var muroTonyL = new Muro(tony, 'tl', 0, 0, 0, 91.5).draw(casa);
    var muro72 = MuroContinuo(muroTonyL, 90, 23).draw(casa);
    var muro73 = MuroContinuo(muro72, 0, 4).draw(casa);
    var muro74 = MuroContinuo(muro73, 90, 12).draw(casa);
    var muro75 = MuroContinuo(muro74, 180, 140).draw(casa);
    var muro76 = MuroContinuo(muro75, 270, 76).draw(casa);
    var muro77 = MuroContinuo(muro76, 180, 24).draw(casa);
    var muro78 = MuroContinuo(muro77, 270, 10).draw(casa);
    var muro79 = MuroContinuo(muro78, 0, 10).draw(casa);
    var muro80 = MuroContinuo(muro79, 270, 18).draw(casa);
    var muro81 = MuroContinuo(muro80, 0, 49).draw(casa);
    var muro82 = MuroContinuo(muro81, 270, 262).draw(casa);
    var muro83 = MuroContinuo(muro82, 180, 70).draw(casa);
    var muro84 = MuroContinuo(muro83, 270, 10).draw(casa);
    var muro85 = MuroContinuo(muro84, 0, 20).draw(casa);
    var muro86 = MuroContinuo(muro85, 270, 8).draw(casa);
    var muro87 = MuroContinuo(muro86, 0, 10).draw(casa);
    var muro88 = MuroContinuo(muro87, 90, 8).draw(casa);
    var muro89 = MuroContinuo(muro88, 0, 51).draw(casa);
    var muro90 = MuroContinuo(muro89, 90, 340).draw(casa);

    var muroTonyR = new Muro(tony, 'tl', 213, 0, 0, 92).draw(casa);
    var muro91 = MuroContinuo(muroTonyR, 270, 440).draw(casa);
    var muro92 = MuroContinuo(muro91, 180, 354).draw(casa);
    var muro93 = MuroContinuo(muro92, 90, 8).draw(casa);
    var muro94 = MuroContinuo(muro93, 180, 10).draw(casa);
    var muro95 = MuroContinuo(muro94, 270, 18).draw(casa);
    var muro96 = MuroContinuo(muro95, 0, 302).draw(casa);
    var muro97 = MuroContinuo(muro96, 270, 8).draw(casa);
    var muro98 = MuroContinuo(muro97, 0, 20).draw(casa);
    var muro99 = MuroContinuo(muro98, 90, 8).draw(casa);
    var muro100 = MuroContinuo(muro99, 0, 82.5).draw(casa);
    var muro101 = MuroContinuo(muro100, 90, 485).draw(casa);
    var muro102 = MuroContinuo(muro101, 180, 142.5).draw(casa);
    var muro103 = MuroContinuo(muro102, 270, 12).draw(casa);
    var muro104 = MuroContinuo(muro103, 0, 10.4).draw(casa);
    var muro105 = MuroContinuo(muro104, 270, 23).draw(casa);

    var muroAndreaElisa = new Muro(andrea, 'tl', 280, 0, 0, 47.5).draw(casa);
    var muro106 = MuroContinuo(muroAndreaElisa, 90, 10).draw(casa);
    var muro107 = MuroContinuo(muro106, 180, 6.5).draw(casa);
    var muro108 = MuroContinuo(muro107, 90, 33).draw(casa);
    var muro109 = MuroContinuo(muro108, 180, 51).draw(casa);
    var muro110 = MuroContinuo(muro109, 270, 33).draw(casa);
    var muro111 = MuroContinuo(muro110, 180, 13.5).draw(casa);
    var muro112 = MuroContinuo(muro111, 270, 10).draw(casa);
    var muro113 = MuroContinuo(muro112, 0, 13.5).draw(casa);
    var muro114 = MuroContinuo(muro113, 270, 502).draw(casa);
    var muro115 = MuroContinuo(muro114, 180, 47).draw(casa);
    var muro116 = MuroContinuo(muro115, 270, 40).draw(casa);
    var muro117 = MuroContinuo(muro116, 0, 144).draw(casa);
    var muro118 = MuroContinuo(muro117, 90, 40).draw(casa);
    var muro119 = MuroContinuo(muro118, 180, 56).draw(casa);
    var muro120 = MuroContinuo(muro119, 90, 9).draw(casa);
    var muro121 = MuroContinuo(muro120, 180, 31).draw(casa);
    var muro122 = MuroContinuo(muro121, 90, 493).draw(casa);

    var muroElisaSalone = new Muro(elisa, 'tl', elisa.width, 0, 270, 502).draw(casa);
    var muro123 = MuroContinuo(muroElisaSalone, 180, 33.5).draw(casa);
    var muro124 = MuroContinuo(muro123, 270, 40).draw(casa);
    var muro125 = MuroContinuo(muro124, 0, 145).draw(casa);
    var muro126 = MuroContinuo(muro125, 90, 40).draw(casa);
    var muro127 = MuroContinuo(muro126, 180, 55).draw(casa);
    var muro128 = MuroContinuo(muro127, 90, 9).draw(casa);
    var muro129 = MuroContinuo(muro128, 180, 32).draw(casa);
    var muro130 = MuroContinuo(muro129, 270, 9).draw(casa);
    var muro131 = MuroContinuo(muro130, 180, 14.5).draw(casa);
    var muro132 = MuroContinuo(muro131, 90, 502).draw(casa);
    var muro133 = MuroContinuo(muro132, 0, 86.5).draw(casa);
    var muro134 = MuroContinuo(muro133, 90, 43).draw(casa);
    var muro135 = MuroContinuo(muro134, 180, 55).draw(casa);
    var muro136 = MuroContinuo(muro135, 270, 33).draw(casa);
    var muro137 = MuroContinuo(muro136, 180, 181.5).draw(casa);
    var muro138 = MuroContinuo(muro137, 270, 10).draw(casa);
    var muro139 = MuroContinuo(muro138, 0, 140).draw(casa);

    var muroSaloneSx = new Muro(elisa, 'tl', 532, 502, 0, 60).draw(casa);
    var muro140 = MuroContinuo(muroSaloneSx, 90, 9).draw(casa);
    var muro141 = MuroContinuo(muro140, 0, 65).draw(casa);
    var muro142 = MuroContinuo(muro141, 270, 9).draw(casa);
    var muro143 = MuroContinuo(muro142, 0, 21).draw(casa);
    var muro144 = MuroContinuo(muro143, 270, 40).draw(casa);
    var muro145 = MuroContinuo(muro144, 180, 146).draw(casa);
    var muro146 = MuroContinuo(muro145, 90, 40).draw(casa);

    var muroSaloneDx = new Muro(elisa, 'tl', 803, 502, 0, 37).draw(casa);
    var muro147 = MuroContinuo(muroSaloneDx, 90, 88).draw(casa);
    var muro148 = MuroContinuo(muro147, 0, 52).draw(casa);
    var muro149 = MuroContinuo(muro148, 270, 88).draw(casa);
    var muro150 = MuroContinuo(muro149, 0, 53).draw(casa);
    var muro151 = MuroContinuo(muro150, 270, 40).draw(casa);
    var muro152 = MuroContinuo(muro151, 180, 142).draw(casa);
    var muro153 = MuroContinuo(muro152, 90, 40).draw(casa);

    var muroCucina = new Muro(elisa, 'tl', 1102, 502, 0, 14).draw(casa);
    var muro154 = MuroContinuo(muroCucina, 90, 417.5).draw(casa);
    var muro155 = MuroContinuo(muro154, 132, 105.5).draw(casa);
    var muro156 = MuroContinuo(muro155, 180, 108).draw(casa);
    var muro157 = MuroContinuo(muro156, 90, 41.5).draw(casa);
    var muro158 = MuroContinuo(muro157, 180, 70).draw(casa);
    var muro159 = MuroContinuo(muro158, 270, 129.5).draw(casa);
    var muro160 = MuroContinuo(muro159, 180, 10).draw(casa);
    var muro161 = MuroContinuo(muro160, 90, 124).draw(casa);
    var muro162 = MuroContinuo(muro161, 180, 166).draw(casa);
    var muro163 = MuroContinuo(muro162, 270, 33).draw(casa);
    var muro164 = MuroContinuo(muro163, 180, 70).draw(casa);
    var muro165 = MuroContinuo(muro164, 90, 45).draw(casa);
    var muro166 = MuroContinuo(muro165, 0, 52).draw(casa);
    var muro167 = MuroContinuo(muro166, 90, 20).draw(casa);
    var muro168 = MuroContinuo(muro167, 0, 20).draw(casa);
    var muro169 = MuroContinuo(muro168, 270, 11.5).draw(casa);
    var muro170 = MuroContinuo(muro169, 0, 442).draw(casa);
    var muro171 = MuroContinuo(muro170, 270, 592).draw(casa);
    var muro172 = MuroContinuo(muro171, 180, 34).draw(casa);
    var muro173 = MuroContinuo(muro172, 90, 40).draw(casa);

    //Rettangolo
    $(casa).on('mouseenter', function(){
        //console.log("asd");
        //$(stanza).animate({svgStroke: 'aqua', svgStrokeWidth: '1'}, 100);
        $(casa).animate({svgStroke: 'red', svgStrokeWidth: '1'}, 100);
    }).on('mouseout', function(){
        //console.log("dsa");
        $(casa).animate({svgStroke: 'blue', svgStrokeWidth: '1'}, 100);
    });
});*/