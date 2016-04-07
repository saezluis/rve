<?php
	
	header('Content-Type: text/html; charset=UTF-8');
	include_once 'config.php';
	
	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");

	$id_proveedor = $_REQUEST['id_send'];
	
	$nombre_proveedor = $_REQUEST['nombre_proveedor'];
	
	mysqli_query($conexion, "UPDATE exhibicion SET nombre = '$nombre_proveedor' WHERE id_exhibicion = $id_proveedor ") or die("Problemas en el select de exhibicion".mysqli_error($conexion));

    echo "Proveedor modificado con éxito";
	echo "<br>";
	echo "<a href=\"admin-proveedores.php\">Volver</a>";
	
?>