<?php
	
	header('Content-Type: text/html; charset=UTF-8');
	include 'config.php';

	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$nombre_real = $_REQUEST['nombre_real'];
	$id_tienda = $_REQUEST['id_tienda'];
	$telefono = $_REQUEST['telefono'];
	$anexo = $_REQUEST['anexo'];
	$cargo = $_REQUEST['cargo'];
	
	
	
	mysqli_query($conexion,"INSERT INTO members (username,password,nombre,tipo_user,id_sala,celular,cargo,anexo,foto_perfil) VALUES 
								('$username',
								'$password',
								'$nombre_real',
								'user',
								'$id_tienda',
								'$telefono',
								'$cargo',
								'$anexo',
								'user.png'
								) ") or die("Problemas con el insert del comentarios");

	echo "Usuario agregado con éxito";
	echo "<br>";
	echo "<a href=\"admin-usuarios.php\">Volver</a>";
	
?>