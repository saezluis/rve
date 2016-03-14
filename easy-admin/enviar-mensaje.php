<?php


	$mensaje_sup = $_REQUEST['mensaje_supervisor'];
	$id_foto_coment = $_REQUEST['foto_activo'];
	
	include_once 'config.php';
	
	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");

	mysqli_query($conexion, "UPDATE registro SET comentario = '$mensaje_sup' WHERE id_registro = $id_foto_coment") 
	or die("Problemas con el insert del registro");

	echo "Comentario enviado con éxito.";
	
?>