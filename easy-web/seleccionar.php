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
  </head>
  <body>
	<?php
		//$sala_store = $_REQUEST['sala'];
		//$_SESSION['s_store'] = $sala_store;
		
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
      </div>
    </header>
    <section class="content">
      <p>Seleccionar campaña</p>
      <form id="campana" method="post" action="como-implementar.php">
        <select class="select" name="campana" onchange="this.form.submit()">
			<?php
			echo "<option value=\"\">Seleccione</option>";
				while($reg=mysqli_fetch_array($registrosCampana)){
					$nombre = $reg['nombre'];
					$id_campana = $reg['id_campana'];
					echo "<option value=\"$id_campana\">$nombre</option>";
				}
			?>
        </select>
      </form>
      <p class="T-exibicion">Seleccionar exhibición</p>
      <form id="exhibicion" method="post" action="como-implementar.php">
        <select class="select" name="exhibicion" onchange="this.form.submit()">
			<?php
			echo "<option value=\"\">Seleccione</option>";
				while($reg=mysqli_fetch_array($registrosExhibicion)){
					$nombre = $reg['nombre'];
					$id_exhibicion = $reg['id_exhibicion'];
					echo "<option value=\"$id_exhibicion\">$nombre</option>";
				}
			?>
        </select>
        <div id="boton-cont">
			<!--
			<input type="submit" value="siguiente" class="cont">
			-->
        </div>
      </form>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>