<?php
	
	session_start();
		header('Content-Type: text/html; charset=UTF-8');
		include "config.php";
	
	 //$host_db = "localhost";
	 //$user_db = "root";
	 //$pass_db = "123";
	 //$db_name = "test";
		$tbl_name = "members";

		// Connect to server and select databse.
		$con=mysqli_connect($host, $username, $password)or die("Cannot Connect to Data Base.");

		mysqli_select_db($con,$db_name)or die("Cannot Select Data Base");

		// sent from form
		$username = $_POST['myusername'];
		$password = $_POST['mypassword'];

		$sql= "SELECT * FROM $tbl_name WHERE username = '$username' and password ='$password'";

		$result=mysqli_query($con,$sql);

		// counting table row
		@$count = mysqli_num_rows(@$result);
		// If result matched $username and $password
		
		if($row=(mysqli_fetch_array($result))){
			$id = $row['id'];
			$tipo_user = $row['tipo_user'];
			$id_sala = $row['id_sala'];
			$nombre_user = $row['nombre'];
		}
		
		//echo "Tipo user: ".$tipo_user;
		//echo "<br>";
		//echo "count: ".$count;
		
		if($count == 1){
		
		$_SESSION['nombre_user'] = $nombre_user;
		$_SESSION['id_sala'] = $id_sala;
		$_SESSION['id_usuario'] = $id;
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (100 * 100 * 60) ;//ojo quitarle las 3 horas a la sesion
	
			if($tipo_user=='user'){
			
				echo '<script type="text/javascript">';
				echo 'window.location.href="seleccionar.php";';
				echo '</script>';	
				
			}
			/*
			if($tipo_user=='user'){
				
				//echo "Entro a tipo user, exito..!";
				//header("Location:emision.php");
				
				echo '<script type="text/javascript">';
				echo 'window.location.href="seleccion-user.php";';
				echo '</script>';
				
			}
			
			if($tipo_user=='boss'){
				
				//echo "Entro a tipo user, exito..!";
				//header("Location:emision.php");
				
				echo '<script type="text/javascript">';
				echo 'window.location.href="seleccion-boss.php";';
				echo '</script>';
				
			}
			
			if($tipo_user=='sap'){
				
				//echo "Entro a tipo user, exito..!";
				//header("Location:emision.php");
				
				echo '<script type="text/javascript">';
				echo 'window.location.href="seleccion-sap.php";';
				echo '</script>';
				
			}
			*/
			
			
			
		}
		else{
			  echo "<h1>Algo ocurrió mal :(</h1>";
			  echo "<p class=\"alarm\">Tu correo o contraseña está incorrecta, haz click <a href=\"login-admin.php\">aquí  </a>para volver a intentarlo.</p>";
			
		}
	
?>
