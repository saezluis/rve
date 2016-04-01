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
	
	<!--
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slides.js"></script>
	-->
	
	<link rel="stylesheet" href="css2/global.css">
	<style>
		#container #list-image{
			margin-top: 1em;
		}

		#container #list-image ul{
			margin: 0;
			padding:0;
			list-style: none;
		}

		#container #list-image ul li{
			float: left;
			margin-right: 1em;
			margin-bottom: 0.5em;
			height: 150px;
			overflow: hidden;
		}


		#list-users{
			   margin-top: 38px;
		}
		#list-users a{
		    padding: 6px 8px;
		    color: #fff;
		    background: #ed1c24;
		    width: 200px;
		    display: inline-block;
		    text-align: center;
		    margin-right: 1em;
		    border-radius: 5px;
		    -webkit-border-radius: 5px;
		    -moz-border-radius: 5px;
		    transition: .3s all;
		}

		#list-users a:hover{
			background: #89030D;
		}


	</style>
	

  </head>
  <body>
	<?php
		$nombre_user = $_SESSION['nombre_user'];
		$foto_perfil = $_SESSION['foto_perfil'];
		
		include_once 'config.php';
	
		$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		/*
		@$comentario_sup = @$_REQUEST['comentario_activo'];
		
		if(@$comentario_sup==1){
			//Esta llegando un comentario
			$mensaje_sup = $_REQUEST['mensaje_supervisor'];			
			$id_foto_coment = $_REQUEST['foto_activo'];
			/*
			echo "mensaje: ".$mensaje_sup;
			echo "<br>";
			echo "id member a quien va el coment: ".$id_member_para;
			echo "<br>";
			echo "id de la foto: ".$id_foto_coment;
			*/
			//mysqli_query($conexion, "UPDATE registro SET comentario = '$mensaje_sup' WHERE id_registro = $id_foto_coment") 
			//or die("Problemas con el insert del registro");
		//}
		
		$cualquiera = 1;
		if(@$_REQUEST['reset_cualquiera']!=''){
			$cualquiera = 2;
		}
		
		$reset_index = @$_REQUEST['reset_inicio'];
		
		$registrosCampana = mysqli_query($conexion,"SELECT * FROM campana") or die("Problemas en el select de campana: ".mysqli_error($conexion));
		$registrosExhibicion = mysqli_query($conexion,"SELECT * FROM exhibicion") or die("Problemas en el select de exhibicion: ".mysqli_error($conexion));
		
		@$id_campana_get = @$_REQUEST['campana'];
		//echo "id_campana: ".$id_campana_get;
		//echo "<br>";
		
		/*
		if(@$id_campana_get!=''){
			$_SESSION['campana_set'] = @$id_campana_get;
		}
		*/
		
		@$id_tienda_get = @$_REQUEST['tienda'];
		//echo "id_tienda: ".$id_tienda_get;
		//echo "<br>";
		
		/*
		if(@$id_tienda_get!=''){
			$_SESSION['tienda_set'] = @$id_tienda_get;
		}
		*/
		
	?>
    <div class="ed-container">
      <div class="ed-item base-20">
        <aside>
          <div class="logo"><img src="img/logo.png" alt=""></div>
          <div class="aqui-les-va">
            <h1>Administrador</h1>
			<div class="init_inicio">
					<form method="post" action="admin-practicas.php">
						<input type="submit" value="Volver">
						<input class="inicio_reset" type="text" value="resetear" name="reset_inicio" hidden=hidden>
					</form>
			</div>
          </div>
        </aside>
      </div>
      <div class="ed-item base-80">
        <header class="int">
          <h1>Administrador General (Version Beta)</h1>
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
			<div id="list-users-practicas">
				<?php
					$texto = '';
					$id_texto = '';
					$id_proveedor = @$_REQUEST['id_proveedor_send'];
					
					if($id_proveedor!=''){
						
						$nombreP = '';
						$registrosProveedor = mysqli_query($conexion,"SELECT * FROM exhibicion WHERE id_exhibicion = '$id_proveedor' ") or die("Problemas en el select de proveedor: ".mysqli_error($conexion));
						
						if($regP=mysqli_fetch_array($registrosProveedor)){
							$nombreP = $regP['nombre'];
						}
						
						$registrosTexto = mysqli_query($conexion,"SELECT * FROM textos WHERE id_proveedor = '$id_proveedor' AND tipo_practica = 'mala' ") or die("Problemas en el select de campana: ".mysqli_error($conexion));
						
						if($regT=mysqli_fetch_array($registrosTexto)){	
							$id_texto = $regT['id_texto'];
							$texto = $regT['texto'];
						}
						
						echo "<p> Usted se encuentra modificando las <b>malas prácticas</b> del proveedor: $nombreP </p>";
						
						echo "<h5>Agregar texto</h5>";
							echo "<form method=\"POST\" action=\"agregar-texto-mp-pro.php\">";
								echo "<input type=\"text\" name=\"id_proveedor_send\" value=\"$id_proveedor\" hidden=hidden>";
								echo "<input type=\"text\" name=\"tipo_practica\" value=\"mala\" hidden=hidden>";
								echo "<input type=\"text\" name=\"id_texto_send\" value=\"$id_texto\" hidden=hidden>";
								echo "<textarea style=\" border: 1px solid #ed1c24; padding: 8px; width: 400px; height: 150px;\" name=\"texto_bp\">$texto</textarea>";
								echo "<input class=\"bootext\" type=\"submit\" value=\"Agregar Texto\" onclick=\"alert('El texto fue agregado')\">";
							echo "</form>";
						
						echo "<h5>Agregar foto</h5>";
						echo "<form  class=\"added\" method=\"POST\" action=\"agregar-foto-mala-pro.php\" enctype=\"multipart/form-data\">";
							echo "<input type=\"text\" name=\"id_proveedor_send\" value=\"$id_proveedor\" hidden=hidden>";
							echo "<input type=\"text\" name=\"condicion\" value=\"mala\" hidden=hidden>";
							echo "<input type=\"file\" name=\"upload\" id=\"upload\" required>";
							echo "<input type=\"submit\" value=\"Subir foto\">";
						echo "</form>";
						
						echo "<h5>Fotos:</h5>";
						
						$registrosFotos = mysqli_query($conexion,"SELECT * FROM fotos_practicas WHERE id_proveedor = '$id_proveedor' AND condicion = 'mala' ") or die("Problemas en el select de campana: ".mysqli_error($conexion));
						
						echo "<ul>";
								while($regF=mysqli_fetch_array($registrosFotos)){
									$nombreF = $regF['nombre'];
									$id_foto = $regF['id_foto'];
									//echo "<li><img src=\"images/$nombreF\" width=\"400px\" height=\"400px\" > <a href=\"\">Eliminar</a> </li>";
									echo "<form method=\"POST\" action=\"eliminar-foto-mala-pro.php\">";			
									
										echo "<input type=\"text\" name=\"id_foto_send\" value=\"$id_foto\" hidden=hidden>";
										echo "<input type=\"text\" name=\"id_exhibicion_send\" value=\"$id_proveedor\" hidden=hidden>";
										
										echo "<li style=\"border-bottom:1px solid #ccc; padding: 1em 0;\"> <img src=\"images/$nombreF\" width=\"400px\" height=\"400px\" > <input type=\"submit\" value=\"eliminar foto\" onclick=\"return confirm('¿ Desea eliminar éste foto ?')\"> </li>";
									echo "</form>";
								}
						echo "</ul>";
					}
					
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