<?php
function CORDIC (&$x1,&$y1,&$z1) { //CORDIC
	$p = 1; // Faz a potenciação do 2^-i.
	for ($i = 0;$i <= 11;$i++){      
		if ($z1 >= 0) {
			$x2 = $x1-$y1/$p;
			$y2 = $y1+$x1/$p;
			$z2 = $z1-atan(1/$p);
		} 
		else{ 
			$x2 = $x1+$y1/$p;
			$y2 = $y1-$x1/$p;
			$z2 = $z1+atan(1/$p);
		}
		
		$x1 = $x2;
		$y1 = $y2;
		$z1 = $z2;
		$p *= 2;
	}	

	
	$x1 = $x1/1.6467;
	$y1 = $y1/1.6467;
}

function q1sin ($angle) {
	$x1 = 0;
	$y1 = 1;

	CORDIC($x1,$y1,$angle);
	
	return -$x1; // Para exibir o seno, já que o cordic exibe o -sin
}

for ($i = 0 ; $i < 4 ; $i++){ // DDS
	for ($j = 0; $j < M_PI/2; $j+=0.017){
		switch ($i){
			case 0:
				$saida = q1sin($j);
				break;
			case 1:
				$saida = q1sin((M_PI/2) - $j);
				break;
			case 2:
				$saida = -q1sin($j);
				break;
			case 3:
				$saida = -q1sin((M_PI/2) - $j);
				break;
		}
		echo "<b>A fase: </b> ".($j+($i*M_PI/2))."</br>";
		echo "<i>Seno: </i> " .sin($j+($i*M_PI/2))."</br>";// - (-1.57)) = -sin ($z1);
		echo "<i>Cosseno: </i> " .cos($j+($i*M_PI/2))."</br>";// - (-1.57)) = -sin ($z1);
		echo "<u>Saida</u>: ".$saida."
</br>";
	}
}
//$grau_rad = 0,02; //1º = 0.017453292 rad

?>