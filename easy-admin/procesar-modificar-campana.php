<?php
	
	header('Content-Type: text/html; charset=UTF-8');
	include_once 'config.php';
	
	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");

	$id_campana = $_REQUEST['id_send'];
	
	$nombre_campana = $_REQUEST['nombre_campana'];
	
	mysqli_query($conexion, "UPDATE campana SET nombre = '$nombre_campana' WHERE id_campana = $id_campana ") or die("Problemas en el select de campana".mysqli_error($conexion));

    echo "Campaña modificada con éxito";
	echo "<br>";
	echo "<a href=\"admin-campanas.php\">Volver</a>";
	
?>