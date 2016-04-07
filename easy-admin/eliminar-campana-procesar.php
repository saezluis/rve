<?php

	header('Content-Type: text/html; charset=utf-8');
	
	$id_campana = $_GET['id_send'];

	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	mysqli_query($conexion,"DELETE FROM campana WHERE id_campana = $id_campana ") or die("Problemas en el select de campana".mysqli_error($conexion));

	echo "Campaña eliminada con éxito";
	echo "<br>";
	echo "<a href=\"admin-campanas.php\">Volver</a>";

?>