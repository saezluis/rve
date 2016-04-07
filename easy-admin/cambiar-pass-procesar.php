<?php
	header('Content-Type: text/html; charset=UTF-8');
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

	$nombre_user = $_SESSION['nombre_user'];
	$foto_perfil = $_SESSION['foto_perfil'];

	$pass_anterior = $_REQUEST['pass_anterior'];
	$password = $_REQUEST['password'];
	$repassword = $_REQUEST['repassword'];
	
	//echo "password: ".$repassword;

	include_once 'config.php';
	
	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosMembers = mysqli_query($conexion, "SELECT * FROM supervisor WHERE username = '$nombre_user' ") or die("Problemas con la conexión de members");

	if($reg=mysqli_fetch_array($registrosMembers)){
		$pass_old = $reg['password'];
		$id_supervisor = $reg['id_supervisor'];
	}
	
	//echo "id supervisor: ".$id_supervisor;
	
	if($pass_anterior==$pass_old){
		//echo "pass viejo correcto";		
		mysqli_query($conexion, "UPDATE supervisor SET password = '$repassword' WHERE id_supervisor = $id_supervisor ") or die("Problemas en el update".mysqli_error($conexion));
		echo "Clave cambiada con éxito";
		echo "<br>";
		echo "<a href=\"admin-perfil.php\">Volver</a>";
	}else{
		echo "Las contraseña antigua es incorrecta";
		echo "<br>";
		echo "<a href=\"cambiar-pass-admin.php\">Volver</a>";
	}
	
	//validar el pass anteior

//luego hacer el update 
	
?>