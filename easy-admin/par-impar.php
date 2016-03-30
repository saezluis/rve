<?php 

$cantidad_comentarios = 8;

for ($x = 1; $x <= $cantidad_comentarios; $x++) {
	//echo "The number is: $x <br>";
	//echo "<li>".$results[$x]."</li>";
	if($x%2 == 0){
		//$class = 'even';
		$nn = 'n'.$x;
		echo $nn;
	}else{
		//$class = 'odd';
		$nm = 'n'.$x;
		echo $nm;
	}
}

	
	
?>