<?php
session_start();

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

	}
	else{
	
		header('Content-Type: text/html; charset=UTF-8'); 	
		echo "<br/>" . "Esta pagina es solo para usuarios registrados." . "<br/>";
		echo "<br/>" . "<a href='login.html'>Hacer Login</a>";
		exit;
	}
	
	$now = time(); // checking the time now when home page starts

	if($now > $_SESSION['expire']){
		session_destroy();
		echo "<br/><br />" . "Su sesion a terminado, <a href='login.html'> Necesita Hacer Login</a>";
		exit;
	}
?>
<?php

	include_once 'config.php';
	
	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");

	$id_campana = $_REQUEST['id_campana'];

	$mostrar_bmp = $_REQUEST['mostrar_bmp'];
	
	echo "id campana: ".$id_campana;
	echo "<br>";
	echo "mostrar bmp: ".$mostrar_bmp;
	echo "<br>";
	
	mysqli_query($conexion, "UPDATE campana SET practica = '$mostrar_bmp' WHERE id_campana = $id_campana ") or die("Problemas en el update de campana".mysqli_error($conexion));
	
	header('Location: admin-practica-principal.php');

?>