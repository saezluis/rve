<?php

	header('Content-Type: text/html; charset=utf-8');
	
	$id_proveedor = $_GET['id_send'];

	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	mysqli_query($conexion,"DELETE FROM exhibicion WHERE id_exhibicion = $id_proveedor ") or die("Problemas en el select de proveedor".mysqli_error($conexion));

	echo "Proveedor eliminado con éxito";
	echo "<br>";
	echo "<a href=\"admin-proveedores.php\">Volver</a>";

?>