<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="123"; // Mysql password 
	$db_name="rve"; // Database name 	

$conexion = mysqli_connect($host,$username,$password);
mysqli_select_db($conexion,$db_name); 
?>