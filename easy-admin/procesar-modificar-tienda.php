<?php
	
	header('Content-Type: text/html; charset=UTF-8');
	include_once 'config.php';
	
	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");

	$id_sala = $_REQUEST['id_send'];
	
	$nombre_sala = $_REQUEST['nombre_sala'];
	
	mysqli_query($conexion, "UPDATE sala SET nombre_sala = '$nombre_sala' WHERE id_sala = $id_sala ") or die("Problemas en el select de la sala".mysqli_error($conexion));

    echo "Tienda modificada con éxito";
	echo "<br>";
	echo "<a href=\"admin-tiendas.php\">Volver</a>";
	
?>