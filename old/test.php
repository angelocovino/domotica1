<?php

                
for($i = 140; $i<=180; $i++){
    echo "var muro" . ($i) . " = MuroContinuo(muro" . ($i-1) . ", 270, 9).draw(casa);<br />";
}
?>