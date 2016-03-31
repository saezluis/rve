<?php
	
	header('Content-Type: text/html; charset=UTF-8');
	include_once 'config.php';
	
	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");

	$id_usuario = $_REQUEST['id_send'];
	
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$nombre_real = $_REQUEST['nombre_real'];
	$id_tienda = $_REQUEST['id_tienda'];
	$telefono = $_REQUEST['telefono'];
	$anexo = $_REQUEST['anexo'];
	$cargo = $_REQUEST['cargo'];
	
	mysqli_query($conexion, "UPDATE members SET username='$username',
									password='$password',
									nombre='$nombre_real',
									id_sala='$id_tienda',
									celular='$telefono',
									anexo='$anexo',
									cargo='$cargo'
									WHERE id='$id_usuario' ") or
									die("Problemas en el select:".mysqli_error($conexion));

    echo "Usuario modificado con éxito";
	echo "<br>";
	echo "<a href=\"admin-usuarios.php\">Volver</a>";
	
?>