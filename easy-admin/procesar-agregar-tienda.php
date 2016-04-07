<?php
	
	header('Content-Type: text/html; charset=UTF-8');
	include 'config.php';

	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$nombre_tienda = $_REQUEST['tienda_name'];	
	
	mysqli_query($conexion,"INSERT INTO sala (nombre_sala) VALUES ('$nombre_tienda') ") or die("Problemas con el insert del comentarios");

	echo "Tienda agregada con éxito";
	echo "<br>";
	echo "<a href=\"admin-tiendas.php\">Volver</a>";
	
?>