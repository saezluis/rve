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
<!DOCTYPE html>
<html ng-app lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<script src="http://code.jquery.com/jquery-latest.js"></script>

	<link rel="stylesheet" href="css/styles.css">
	
	<link href="//cdn.rawgit.com/noelboss/featherlight/1.3.5/release/featherlight.min.css" type="text/css" rel="stylesheet" />
	
    <title>Administrador General del Sistema RVE</title>

	<link rel="stylesheet" href="css2/global.css">
	
  </head>
  <body>
	<?php
		$nombre_user = $_SESSION['nombre_user'];
		$foto_perfil = $_SESSION['foto_perfil'];
		
		include_once 'config.php';
	
		$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		
		
	?>
    <div class="ed-container">
      <div class="ed-item base-20">
        <aside>
          <div class="logo"><img src="img/logo.png" alt=""></div>
          <div class="aqui-les-va">
            <h1>Administrador</h1>
			<div class="init_inicio">
					<form method="post" action="admin-usuarios.php">
						<input type="submit" value="Volver">
						<input class="inicio_reset" type="text" value="resetear" name="reset_inicio" hidden=hidden>
					</form>
			</div>
          </div>
        </aside>
      </div>
      <div class="ed-item base-80">
        <header class="int">
          <h1>Administrador General</h1>
          <div class="items-header">
            <div class="custion">
			<?php
				
				echo "<div class=\"profile\"><img src=\"img/$foto_perfil\" alt=\"\" class=\"circulo\"></div>";
				echo "<p class=\"nombre\">¡Hola! $nombre_user.</p><a href=\"logout.php\" class=\"rejected\">Cerrar sesión</a>";
			?>  
            </div>
          </div>
        </header>
		
		<div id="container">
			<div id="example">
				<?php			
					echo "<br>";					
					echo "<h4>Agregar usuario</h4>";
					
					$registrosTienda = mysqli_query($conexion," SELECT * from sala ") or die("Problemas en el select de tienda: ".mysqli_error($conexion));
					/*
					echo "<th>Usuario</th>";
					echo "<th>Password</th>";
					echo "<th>Nombre</th>";
					echo "<!-- <th>Tipo de usuario</th> -->";
					echo "<th>Tienda</th>";
					echo "<th>Teléfono</th>";
					echo "<th>Anexo</th>";
					echo "<th>Cargo</th>";
					echo "<!-- <th>Foto perfil</th> -->";
					*/			
					echo "<form class=\"my-hero-form\" method=\"POST\" action=\"procesar-agregar-usuario.php\">";
					echo "<label>Usuario:</label> <input type=\"text\" name=\"username\" required>";
					echo "<label>Contraseña:</label> <input type=\"password\" name=\"password\" required>";
					echo "<label>Nombre completo:</label> <input type=\"text\" name=\"nombre_real\" required>";
					echo "<label>Tienda:</label> <select name=\"id_tienda\">";			
						echo "<option value=\"-1\">Seleccione</option>";
						while($regT=mysqli_fetch_array($registrosTienda)){
							$id_sala = $regT['id_sala'];
							$nombre_sala = $regT['nombre_sala'];							
							echo "<option value=\"$id_sala\">$nombre_sala</option>";
						}
					echo "</select>";
				
					echo "<label>Teléfono:</label> <input type=\"text\" name=\"telefono\" required>";
					echo "<label>Anexo:</label> <input type=\"text\" name=\"anexo\" >";
					echo "<label>Cargo:</label> <select name=\"cargo\">";			
						echo "<option value=\"-1\">Seleccione</option>";
						echo "<option value=\"Jefe de Visual\">Jefe de Visual</option>";
						echo "<option value=\"Publicista\">Publicista</option>";
						echo "<option value=\"Flejista\">Flejista</option>";
						echo "<option value=\"Gerente\">Gerente</option>";						
					echo "</select>";

					echo "<input type=\"submit\" value=\"Aceptar\">";
					echo "<a class=\"cancel\" href=\"admin-usuarios.php\">Cancelar</a>";
					echo "</form>";
				?>
			</div>			
		</div>		
     </div>
    </div>
	<!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	-->
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<!--
    <script src="js/scripts.js"></script>
	-->
	
	<script src="//cdn.rawgit.com/noelboss/featherlight/1.3.5/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
  </body>
</html>