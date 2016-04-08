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
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <title>Registro Visual Easy</title>
	
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	
	<script type="text/javascript">
	
		$( document ).ready(function() {
	 
		// Your code here.
	 
			$('input').blur(function() {
				var pass = $('input[name=password]').val();
				var repass = $('input[name=repassword]').val();
					if(($('input[name=password]').val().length == 0) || ($('input[name=repassword]').val().length == 0)){
						$('#password').addClass('has-error');
					}
					else if (pass != repass) {
						//$('#password').addClass('has-error');
						//$('#repassword').addClass('has-error');
						alert('Las claves no coinciden');
						document.getElementById("repass").focus();
					}
					else {
						//$('#password').removeClass().addClass('has-success');
						//$('#repassword').removeClass().addClass('has-success');
						var tapa;
					}
			});
		
		});
	
	</script>
	
  </head>
  <body>
	<?php
		//$sala_store = $_REQUEST['sala'];
		//$_SESSION['s_store'] = $sala_store;
		$nombre_user = $_SESSION['nombre_user'];
		
		$_SESSION['c_store'] = "";
		$_SESSION['e_store'] = "";
		
		include_once 'config.php';
	
		$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
	
		$registrosCampana = mysqli_query($conexion,"SELECT * FROM campana") or die("Problemas en el select de campana: ".mysqli_error($conexion));
		$registrosExhibicion = mysqli_query($conexion,"SELECT * FROM exhibicion") or die("Problemas en el select de exhibicion: ".mysqli_error($conexion));
		
	?>
    <header>
      <div class="ed-container">
        <div class="ed-item base-100">
          <div class="logo__interiores"><img src="img/logo.png" alt=""></div>
        </div>
          <div class="profile">
			<?php
				echo "<p>Hola <span>$nombre_user</span></p>";
			?>
            <div class="getOut"><a href="mi-perfil.php">Volver</a></div>
          </div>
      </div>
    </header>
    <section class="content">		
		<?php

		//$nombre_user = $_SESSION['nombre_user'];
		//$foto_perfil = $_SESSION['foto_perfil'];
		$username_member = $_SESSION['username'];

		//echo "nombre user: ".$nombre_user;
		
		$pass_anterior = $_REQUEST['pass_anterior'];
		$password = $_REQUEST['password'];
		$repassword = $_REQUEST['repassword'];
		
		//echo "password: ".$repassword;

		include_once 'config.php';
		
		$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$registrosMembers = mysqli_query($conexion, "SELECT * FROM members WHERE username = '$username_member' ") or die("Problemas con la conexión de members");

		if($reg=mysqli_fetch_array($registrosMembers)){
			$pass_old = $reg['password'];
			$id_member = $reg['id'];
		}
		
		//echo "id supervisor: ".$id_supervisor;
		
		if($pass_anterior==$pass_old){
			//echo "pass viejo correcto";		
			mysqli_query($conexion, "UPDATE members SET password = '$repassword' WHERE id = $id_member ") or die("Problemas en el update".mysqli_error($conexion));			
			echo "<h1>Clave cambiada con éxito</h1>";
			echo "<div class=\"menu-perfils\">";
				echo "<br>";
				echo "<ul>";
					echo "<li><a href=\"mi-perfil.php\">Volver</a></li>";
				echo "</ul>";
			echo "</div>";
		}else{
			echo "<h1>Las contraseña antigua es incorrecta</h1>";
			echo "<div class=\"menu-perfils\">";
				echo "<br>";
				echo "<ul>";
					echo "<li><a href=\"cambiar-pass.php\">Volver</a></li>";
				echo "</ul>";
			echo "</div>";
		}
		
		//validar el pass anteior

	//luego hacer el update 
	
	?>
		
		
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
