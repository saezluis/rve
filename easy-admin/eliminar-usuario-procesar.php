<?php

	header('Content-Type: text/html; charset=utf-8');
	
	$id_usuario = $_GET['id_send'];

	include "config.php";
		
	$conexion=mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	mysqli_query($conexion,"DELETE FROM members WHERE id = '$id_usuario'") or	die("Problemas en el select:".mysqli_error($conexion));

	echo "Usuario eliminado con éxito";
	echo "<br>";
	echo "<a href=\"admin-usuarios.php\">Volver</a>";

?>