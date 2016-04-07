<?php
	
	header('Content-Type: text/html; charset=UTF-8');
	include 'config.php';

	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$nombre_campana = $_REQUEST['campana_name'];	
	
	mysqli_query($conexion,"INSERT INTO campana (nombre) VALUES ('$nombre_campana') ") or die("Problemas con el insert de campañas");

	echo "Campaña agregada con éxito";
	echo "<br>";
	echo "<a href=\"admin-campanas.php\">Volver</a>";
	
?>