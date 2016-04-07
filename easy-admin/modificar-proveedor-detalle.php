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
		
		$id_proveedor = $_GET['id_send'];
		
		//echo "id usuario: ".$id_usuario;
		
	?>
    <div class="ed-container">
      <div class="ed-item base-20">
        <aside>
          <div class="logo"><img src="img/logo.png" alt=""></div>
          <div class="aqui-les-va">
            <h1>Administrador</h1>
			<div class="init_inicio">
					<form method="post" action="admin-proveedores.php">
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
					echo "<h4>Modificar proveedor</h4>";
					
					//$registrosUsuario = mysqli_query($conexion," SELECT * from members WHERE id = '$id_usuario'") or die("Problemas en el select de tienda: ".mysqli_error($conexion));
					
					$registrosTienda = mysqli_query($conexion," SELECT * from exhibicion WHERE id_exhibicion = $id_proveedor ") or die("Problemas en el select de tienda: ".mysqli_error($conexion));
					
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
					
					if($regU=mysqli_fetch_array($registrosTienda)){
						$nombre_proveedor = $regU['nombre'];						
					}
					
					echo "<form class=\"my-hero-form\" method=\"POST\" action=\"procesar-modificar-proveedor.php\">";
					echo "<input type=\"text\" name=\"id_send\" value=\"$id_proveedor\" hidden=hidden>";
					echo "Nombre sala: <input type=\"text\" name=\"nombre_proveedor\" value=\"$nombre_proveedor\" >";
					

					echo "<input type=\"submit\" value=\"Modificar\">";
					echo "<a class=\"cancel\" href=\"modificar-proveedores.php\">Volver</a>";
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