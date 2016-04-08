<?php
session_start();

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

	}
	else{
	
		header('Content-Type: text/html; charset=UTF-8'); 	
		echo "<br/>" . "Esta pagina es solo para usuarios registrados." . "<br/>";
		echo "<br/>" . "<a href='index.html'>Hacer Login</a>";
		exit;
	}
	
	$now = time(); // checking the time now when home page starts

	if($now > $_SESSION['expire']){
		session_destroy();
		echo "<br/><br />" . "Su sesion a terminado, <a href='index.html'> Necesita Hacer Login</a>";
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
		<h1>Cambiar datos cuenta</h1>
		<form class="cambia_contra" method="POST" action="cambiar-pass-procesar.php">
			<label for="">Contraseña anterior</label>
			<input type="password" name="pass_anterior" required>
			<label for="">Contraseña nueva</label>
			<input type="password" class="form-control" name="password" required>
			<label for="">Repita contraseña</label>
			<input type="password" id="repass" class="form-control" name="repassword" required>
			<input type="submit" value="Cambiar">
		</form>	
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>