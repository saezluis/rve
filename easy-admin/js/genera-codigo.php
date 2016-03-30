<?php

$cantidad_datos = 2000	;
/*
for ($xx = 1; $xx <= $cantidad_datos; $xx++) {
	echo "$('#message$xx').submit(function(e) {"."<br>";
			echo "<br>";
				echo "var url = \"enviar-mensaje.php\"; // the script where you handle the form input."."<br>";
				echo "<br>";
				echo "$.ajax({"."<br>";
					   echo "type: \"POST\","."<br>";
					   echo "url: url,"."<br>";
					   echo "data: $('#message$xx').serialize(), // serializes the form's elements."."<br>";
					   echo "success: function(data)"."<br>";
					   echo "{"."<br>";
						   echo "alert(data); // show response from the php script."."<br>";
					   echo "}"."<br>";
					 echo "});"."<br>";
					echo "<br>";
				echo "e.preventDefault(); // avoid to execute the actual submit of the form."."<br>";
			echo "<br>";
			echo "});"."<br>";
			echo "<br>";
			echo "<br>";
}
*/
for ($xx = 0; $xx <= $cantidad_datos; $xx++) {
	if($xx%2 == 0){
		echo "var n$xx = document.getElementById('n$xx');"."<br>";
		$xx = $xx + 1;
		echo "var n$xx = document.getElementById('n$xx');"."<br>";	
		echo "n$xx.value = ";
		$xx = $xx - 1;
		echo "n$xx.value;"."<br>";	
		echo "<br>";
	}
}
/*
	if($i%2 == 0)
   {
      $class = 'even'; par
   }
   else
   {
      $class = 'odd'; impar
   }
*/

?>