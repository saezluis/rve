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
		
		$textoCheckB = '';
		$textoCheckM = '';
		$nombreFoto = '';
		
		include_once 'config.php';
	
		$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$id_proveedor = @$_REQUEST['id_proveedor'];
		
		$registrosProveedorCheck = mysqli_query($conexion, " SELECT * FROM exhibicion WHERE id_exhibicion = '$id_proveedor' ") or die("Problemas con la conexión de campana");
		
		if($regCampCheck=mysqli_fetch_array($registrosProveedorCheck)){			
			$archivo_pdfCheck = $regCampCheck['archivo_pdf'];
		}
		
		
		$textosCheckBuenos = mysqli_query($conexion, " SELECT * FROM textos WHERE id_proveedor = '$id_proveedor' AND tipo_practica = 'buena' ") or die("Problemas con la conexión de campana");
		
		if($regTextosB=mysqli_fetch_array($textosCheckBuenos)){
			$textoCheckB = $regTextosB['texto'];
		}
		
		$textosCheckMalos= mysqli_query($conexion, " SELECT * FROM textos WHERE id_proveedor = '$id_proveedor' AND tipo_practica = 'mala' ") or die("Problemas con la conexión de campana");
		
		if($regTextosM=mysqli_fetch_array($textosCheckMalos)){
			$textoCheckM = $regTextosM['texto'];
		}
		
		
		$fotosCheck = mysqli_query($conexion, " SELECT * FROM fotos_practicas WHERE id_proveedor = '$id_proveedor' ") or die("Problemas con la conexión de campana");
		
		if($regFotosCheck=mysqli_fetch_array($fotosCheck)){
			$nombreFoto = $regFotosCheck['nombre'];
		}
		
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
			<div id="list-users-practicas">
				<?php
					
					$id_campana = @$_REQUEST['id_campana'];
					
					
					if($id_proveedor!=''){
						
						$mostrar_bmp = @$_REQUEST['mostrar_bmp'];
					
						if($mostrar_bmp!=''){
							mysqli_query($conexion, "UPDATE exhibicion SET practica = '$mostrar_bmp' WHERE id_exhibicion = $id_proveedor ") or die("Problemas en el update de campana".mysqli_error($conexion));
							echo "<script>";
								echo "alert('Información: mostrar en aplicación web actualizado');";
							echo "</script>";
							
						}
						
						$nombreP = '';
						$registrosProveedor = mysqli_query($conexion,"SELECT * FROM exhibicion WHERE id_exhibicion = '$id_proveedor' ") or die("Problemas en el select de campana: ".mysqli_error($conexion));
						
						if($regP=mysqli_fetch_array($registrosProveedor)){
							$nombreP = $regP['nombre'];
							$practica_mostrar = $regP['practica'];
							$archivo_pdf = $regP['archivo_pdf'];
						}
						
						echo "Usted se encuentra modificando las buenas/malas prácticas del proveedor: <b>$nombreP</b>";
						echo "<br>";
						echo "<br>";
						if($archivo_pdf!=''){
							echo "Archivo asociado a éste proveedor: $archivo_pdf<a href=\"archivos/$archivo_pdf\" download> -> Descargar</a> ó <a href=\"eliminar-archivo-pro.php?id_send=",urlencode($id_proveedor)," \" onclick=\"return confirm('¿ Desea eliminar ésta archivo ?')\"> Eliminar </a>";
						}else{
							echo "Ëste proveedor no tiene archivo PDF asociado";
						}
						//echo "<td><a class=\"equis\" href=\"eliminar-proveedor-procesar.php?id_send=",urlencode($id_proveedor)," \" onclick=\"return confirm('¿ Desea eliminar ésta proveedor ?')\">x</a></td>";
						echo "<br>";
						
						if($textoCheckB=='' && $textoCheckM=='' && $nombreFoto==''){
							echo "Subir archivo PDF:";
								echo "<form  class=\"added\" method=\"POST\" action=\"agregar-archivo-p.php\" enctype=\"multipart/form-data\">";
									//echo "<input type=\"text\" name=\"id_campana\" value=\"$id_campana\" hidden=hidden>";
									echo "<input type=\"text\" name=\"id_camp\" value=\"$id_proveedor\" hidden=hidden>";
									echo "<input type=\"file\" name=\"upload\" id=\"upload\" required>";
									echo "<input type=\"submit\" value=\"Subir archivo\">";
								echo "</form>";
							
							echo "<br>";
						}
						
						if($archivo_pdfCheck==''){
							echo "<p>Seleccione una opción:</p>";						
								echo "<ul>";
									echo "<form method=\"post\" action=\"buenas-practicas-pro.php\">";
										echo "<input type=\"text\" name=\"id_proveedor_send\" value=\"$id_proveedor\" hidden=hidden>";
										echo "<li><input type=\"submit\" value=\"Buenas prácticas\"></li>";
										echo "</form>";
									echo "<form method=\"post\" action=\"malas-practicas-pro.php\">";
										echo "<input type=\"text\" name=\"id_proveedor_send\" value=\"$id_proveedor\" hidden=hidden>";
										echo "<li><input type=\"submit\" value=\"Malas prácticas\"></li>";
									echo "</form>";
								echo "</ul>";
							echo "</form>";
							echo "<h6>Nota: para mostrar buenas/malas prácticas en la app web es necesario agregar 1 foto/comentario por cada buena/mala práctica.</h6>";
						}
						
						echo "<p>Mostrar en aplicación web:</p>";
							echo "<form method=\"POST\" action=\"admin-practica-proveedores.php\" >";
								echo "<select name=\"mostrar_bmp\" onchange=\"this.form.submit()\" >";
									echo "<option value=\"-1\" >-- Seleccione --</option>";
									if($practica_mostrar=='si'){
										echo "<option value=\"si\" selected=selected >Sí</option>";
										echo "<option value=\"no\" >No</option>";
									}
									if($practica_mostrar=='no'){
										echo "<option value=\"si\" >Sí</option>";
										echo "<option value=\"no\" selected=selected>No</option>";
									}
								echo "</select>";
								echo "<input type=\"text\" name=\"id_campana\" value=\"$id_campana\" hidden=hidden>";
								echo "<input type=\"text\" name=\"id_proveedor\" value=\"$id_proveedor\" hidden=hidden>";
							echo "</form>";
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