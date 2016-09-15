<?php
function convertHSL($h, $s, $l, $toHex=true){
    $h /= 360;
    $s /=100;
    $l /=100;

    $r = $l;
    $g = $l;
    $b = $l;
    $v = ($l <= 0.5) ? ($l * (1.0 + $s)) : ($l + $s - $l * $s);
    if ($v > 0){
          $m;
          $sv;
          $sextant;
          $fract;
          $vsf;
          $mid1;
          $mid2;

          $m = $l + $l - $v;
          $sv = ($v - $m ) / $v;
          $h *= 6.0;
          $sextant = floor($h);
          $fract = $h - $sextant;
          $vsf = $v * $sv * $fract;
          $mid1 = $m + $vsf;
          $mid2 = $v - $vsf;

          switch ($sextant)
          {
                case 0:
                      $r = $v;
                      $g = $mid1;
                      $b = $m;
                      break;
                case 1:
                      $r = $mid2;
                      $g = $v;
                      $b = $m;
                      break;
                case 2:
                      $r = $m;
                      $g = $v;
                      $b = $mid1;
                      break;
                case 3:
                      $r = $m;
                      $g = $mid2;
                      $b = $v;
                      break;
                case 4:
                      $r = $mid1;
                      $g = $m;
                      $b = $v;
                      break;
                case 5:
                      $r = $v;
                      $g = $m;
                      $b = $mid2;
                      break;
          }
    }
    $r = round($r * 255, 0);
    $g = round($g * 255, 0);
    $b = round($b * 255, 0);

    if ($toHex) {
        $r = ($r < 15)? '0' . dechex($r) : dechex($r);
        $g = ($g < 15)? '0' . dechex($g) : dechex($g);
        $b = ($b < 15)? '0' . dechex($b) : dechex($b);
        return "#$r$g$b";
    } else {
        return "rgb($r, $g, $b)";    
    }
}
function rgbToHsl( $r, $g, $b ) {
	$oldR = $r;
	$oldG = $g;
	$oldB = $b;
	$r /= 255;
	$g /= 255;
	$b /= 255;
    $max = max( $r, $g, $b );
	$min = min( $r, $g, $b );
	$h;
	$s;
	$l = ( $max + $min ) / 2;
	$d = $max - $min;
    	if( $d == 0 ){
        	$h = $s = 0; // achromatic
    	} else {
        	$s = $d / ( 1 - abs( 2 * $l - 1 ) );
		switch( $max ){
	            case $r:
	            	$h = 60 * fmod( ( ( $g - $b ) / $d ), 6 ); 
                        if ($b > $g) {
	                    $h += 360;
	                }
	                break;
	            case $g: 
	            	$h = 60 * ( ( $b - $r ) / $d + 2 ); 
	            	break;
	            case $b: 
	            	$h = 60 * ( ( $r - $g ) / $d + 4 ); 
	            	break;
	        }			        	        
	}
	return array( round( $h, 2 ), round( $s, 2 ), round( $l, 2 ) );
}

if(isset($_GET['color'])){
    $colore = explode("_", $_GET['color']);
    $color = convertHSL($colore[0], floatval($colore[1]) * 100, floatval($colore[2]) * 100);
    $colorScuro = convertHSL($colore[0], floatval($colore[1]) * 100, (floatval($colore[2]) * 100) - 16);
    $colorChiaro = convertHSL($colore[0], floatval($colore[1]) * 100, (floatval($colore[2]) * 100) + 16);
    //$color = "rgb(" . $colore[0] . ", " . $colore[1] . "," . $colore[2] . ")";
    //$color = "#FFD422";
}else if(isset($_GET['rgb'])){
    $color = $_GET['rgb'];
    //$color = "255000000";
    $r = substr($color, 0, 3);
    $g = substr($color, 3, 3);
    $b = substr($color, 6, 3);
    $colore = rgbToHsl($r, $g, $b);
    $color = convertHSL($colore[0], floatval($colore[1]) * 100, floatval($colore[2]) * 100);
    $colorScuro = convertHSL($colore[0], floatval($colore[1]) * 100, (floatval($colore[2]) * 100) - 16);
    $colorChiaro = convertHSL($colore[0], floatval($colore[1]) * 100, (floatval($colore[2]) * 100) + 16);
    //$color = "#" . $_GET['rgb'];
    //$colorScuro = "#" . $_GET['rgb'];
    //$colorChiaro = "#" . $_GET['rgb'];
}else{
    $color = "#FFD422";
};

header('Content-type: image/svg+xml');
?><?xml version="1.0" encoding="iso-8859-1"?><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
<g>
	<path style="fill:<?php echo $colorScuro; ?>;" d="M325.712,320.973c-10.93,27.821-38.011,47.527-69.71,47.527l0,0v-47.527H325.712z"/>
	<path style="fill:<?php echo $colorScuro; ?>;" d="M256.001,293.607h74.891c0,9.661-1.849,18.886-5.181,27.365h-69.71V293.607z"/>
</g>
<path style="fill:<?php echo $color; ?>;" d="M186.291,320.973c10.93,27.821,38.011,47.527,69.71,47.527l0,0v-47.527H186.291z"/>
<path style="fill:<?php echo $colorScuro; ?>;" d="M256.001,293.607H181.11c0,9.661,1.849,18.886,5.181,27.365h69.71V293.607z"/>
<path style="fill:#<?php echo $colorChiaro; ?>;" d="M256.001,368.499c0.066,0,0.129-0.004,0.195-0.004C256.13,368.494,256.067,368.499,256.001,368.499
	L256.001,368.499z"/>
<path style="fill:#787680;" d="M256.001,184.052c-9.241,0-16.732-7.491-16.732-16.732V16.732C239.269,7.491,246.761,0,256.001,0
	s16.732,7.491,16.732,16.732V167.32C272.733,176.561,265.242,184.052,256.001,184.052z"/>
<path style="fill:#57565C;" d="M256.001,0c-0.37,0-0.732,0.031-1.097,0.056v183.941c0.364,0.023,0.726,0.056,1.097,0.056
	c9.241,0,16.732-7.491,16.732-16.732V16.732C272.733,7.491,265.242,0,256.001,0z"/>
<g>
	<path style="fill:<?php echo $color; ?>;" d="M256.001,512c-9.241,0-16.732-7.492-16.732-16.732v-68.044c0-9.241,7.491-16.732,16.732-16.732
		s16.732,7.491,16.732,16.732v68.044C272.733,504.508,265.242,512,256.001,512z"/>
	<path style="fill:<?php echo $color; ?>;" d="M117.925,462.994c-4.282,0-8.565-1.633-11.831-4.901c-6.534-6.534-6.534-17.128,0-23.662
		l48.115-48.115c6.533-6.534,17.128-6.534,23.662,0c6.534,6.534,6.534,17.128,0,23.662l-48.115,48.115
		C126.489,461.361,122.206,462.994,117.925,462.994z"/>
</g>
<g>
	<path style="fill:<?php echo $colorScuro; ?>;" d="M394.077,462.994c-4.282,0-8.563-1.633-11.831-4.901l-48.113-48.115
		c-6.534-6.534-6.534-17.128,0-23.662c6.534-6.534,17.128-6.533,23.662,0l48.113,48.115c6.534,6.534,6.534,17.128,0,23.662
		C402.642,461.36,398.359,462.994,394.077,462.994z"/>
	<path style="fill:<?php echo $colorScuro; ?>;" d="M256.001,410.492c-0.37,0-0.732,0.031-1.097,0.056v101.397c0.364,0.023,0.726,0.056,1.097,0.056
		c9.241,0,16.732-7.492,16.732-16.732v-68.044C272.733,417.984,265.242,410.492,256.001,410.492z"/>
</g>
<path style="fill:#3D9AE2;" d="M256.001,91.091c-106.483,0-193.113,86.631-193.113,193.113c0,9.241,7.491,16.732,16.732,16.732
	h352.761c9.241,0,16.732-7.491,16.732-16.732C449.113,177.721,362.484,91.091,256.001,91.091z"/>
<path style="fill:#1E81CE;" d="M256.001,91.091v209.845h176.38c9.241,0,16.732-7.491,16.732-16.732
	C449.113,177.721,362.484,91.091,256.001,91.091z"/>
</svg>