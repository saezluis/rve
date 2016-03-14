<?php
	
	$headers = "Content-Type: text/html; charset=UTF-8";
	
	echo "Comentario enviado con éxito.";
		
	$mensaje_sup = $_REQUEST['mensaje_supervisor'];
	$id_foto_coment = $_REQUEST['foto_activo'];
	$email_user = $_REQUEST['email_activo'];
	$campana = $_REQUEST['campana_activa'];
	
	include_once 'config.php';
	
	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");

	mysqli_query($conexion, "UPDATE registro SET comentario = '$mensaje_sup' WHERE id_registro = $id_foto_coment") 
	or die("Problemas con el insert del registro");

	$to = $email_user;
	$subject = "Comentario sobre: $campana";
	$headers = "De: Supervisión Easy";
	$message = $mensaje_sup;
	
	mail($to, '=?utf-8?B?'.base64_encode($subject).'?=' ,$message, '=?utf-8?B?'.base64_encode($headers).'?=' );
	
	
	
	
?>