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
    <link rel="stylesheet" href="css/set2.css">
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <title>Registro Visual Easy</title>
  </head>
  <body>
	<?php
		$nombre_user = $_SESSION['nombre_user'];
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
            <div class="getOut"><a href="logout.php">Cerrar Sesión</a></div>
          </div>
      </div>
    </header>
    <section class="content">
      <p class="Des-Movile">Tomar foto</p>
      <p class="Des-Web">Subir foto</p>
      <form id="main" method="post" action="finish.php" enctype="multipart/form-data">
        <div class="upload">
          <input type="file" accept="image/*" capture="camera" name="upload" id="upload" onchange="this.form.submit()" required>
        </div>
        <div id="boton-cont">
			<!--
			<input type="submit" value="siguiente" class="cont">
			-->
			<input type="text" value="si" name="siguiente_send" hidden=hidden>			
	  </form>
		<!--
		
		-->
			<br>			
			<form method="post" action="finish.php">
				<?php
					
					$desde_implementar = @$_REQUEST['aceptar_implementar'];
					$desde_implementar2 = @$_GET['imp'];
					if($desde_implementar=='si' || $desde_implementar2=='si'){
						//$nothing = "";
						//echo "<section class=\"go\"><a href=\"#\"><input type=\"submit\" value=\"Volver\" class=\"cont\"></a></section>";
						echo "<input type=\"button\" onclick=\"location.href='seleccionar.php';\" value=\"volver\" class=\"cont\" style=\"margin-top:15px;\">";
					}else{
						echo "<input type=\"button\" onclick=\"location.href='finish.php';\" value=\"cancelar\" class=\"cont\" style=\"margin-top:15px;\">";
						//echo "<section class=\"go\"><a href=\"#\"><input type=\"submit\" value=\"Volver\" class=\"cont\"></a></section>";
					}				
				?>
			</form>						
        </div>
      
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>