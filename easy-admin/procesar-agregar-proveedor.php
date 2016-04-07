<?php
	
	header('Content-Type: text/html; charset=UTF-8');
	include 'config.php';

	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$nombre_proveedor = $_REQUEST['proveedor_name'];
	
	mysqli_query($conexion,"INSERT INTO exhibicion (nombre) VALUES ('$nombre_proveedor') ") or die("Problemas con el insert de proveedores");

	echo "Proveedor agregado con éxito";
	echo "<br>";
	echo "<a href=\"admin-proveedores.php\">Volver</a>";
	
?>