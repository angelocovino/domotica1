<?php include("include/header.php"); ?>








<?php

    include("include/dbmanagement.php");
    $db= new dbmanagment();
    $db->opendatabase();
    $db->createDB();

   /*  $db->addEvents(10,10,19,9,2016,8);
     $db->addEvents(11,10,19,9,2016,8);
     $db->addEvents(12,10,19,9,2016,8);
     $db->addEvents(10,10,20,9,2016,8);
     $db->addEvents(10,10,20,9,2016,8);*/

    $str = $db->getEventsWithParams(9,2016);



$mesi = array(1=>'Gennaio', 'Febbraio', 'Marzo', 'Aprile',
                'Maggio', 'Giugno', 'Luglio', 'Agosto',
                'Settembre', 'Ottobre', 'Novembre','Dicembre');

$giorni = array('Lunedi','Martedi','Mercoledi',
                'Giovedi','Venerdi','Sabato','Domenica');
?>




<form action="" method="get">

     Evento <select name="evento">
   
    <?php
    
        $result = $db->getComando();
        foreach($result as $row){
            echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</Option>";
        }  
    
    ?>
    
    </select> 
    
</form>


<script>
    $(document).ready(function(){
        $("table").on("swipe",function(){
          $(this).hide();
        });
    })
</script>

<div class="CalendarioCont">

<?php
    for ($m = 1; $m <= 12; $m++){

        echo "<h3>".$mesi[date("n", mktime(0,0,0,$m+1,0,0))]."</h3>";

        echo "<table class='calendario'>";  
        echo "<thead><tr>";
        for($d=0;$d<8;$d++){
            echo "<th>{$giorni[$d]}</th>";            
        }
        echo "</tr></thead><tbody><tr>";            
        
        $num = cal_days_in_month(CAL_GREGORIAN, $m, date("Y"));

        for($i = 1; $i <= $num; $i++){
            $gs = date('N',mktime(0,0,0,$m,$i,date("Y")));
            if($i==1){
                for($k=0;$k<$gs-1;$k++){
                    echo "<td></td>";
                }
            }
            if($gs == 1 )echo "</tr><tr>";
            echo "<td>". $i ."</td>";
        }
        echo "</tr></tbody>"; 
        echo "</table>";
    } 
    ?>

</div>

<?php include("include/footer.php"); ?>