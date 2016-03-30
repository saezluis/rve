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
	
	<link href="css/featherlight.css" type="text/css" rel="stylesheet" />
	
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
		$registrosSala = mysqli_query($conexion,"SELECT * FROM sala") or die("Problemas en el select de sala: ".mysqli_error($conexion));
		
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
					<form method="post" action="admin.php">
						<input type="submit" value="Inicio">
						<input class="inicio_reset" type="text" value="resetear" name="reset_inicio" hidden=hidden>
					</form>
			</div>			
            <form id="choose" method="post" action="admin.php" >             
              <div class="tienda">
                <h2>Historial de fotos:</h2>				
				<h2 style="margin-top: 14px;">Por tienda</h2>
                <select class="select" name="tienda" onchange="this.form.submit()">
					<?php
						echo "<option value=\"0\">Seleccione</option>";
						while($reg=mysqli_fetch_array($registrosSala)){
							$nombre_sala = $reg['nombre_sala'];
							$id_sala = $reg['id_sala'];
							if(@$id_tienda_get==$id_sala){
								echo "<option value=\"$id_sala\" selected=selected>$nombre_sala</option>";
							}else{
								echo "<option value=\"$id_sala\">$nombre_sala</option>";
							}
						}
					?>
				</select>
              </div>
			  <div class="campana">
                <h2>Por campaña</h2>                
				<select class="select" name="campana" onchange="this.form.submit()">
					<?php
						echo "<option value=\"0\">Seleccione</option>";
						while($reg=mysqli_fetch_array($registrosCampana)){
							$nombre = $reg['nombre'];
							$id_campana = $reg['id_campana'];
							if(@$id_campana_get==$id_campana){
								echo "<option value=\"$id_campana\" selected=selected>$nombre</option>";
							}else{
								echo "<option value=\"$id_campana\">$nombre</option>";
							}							
						}
					?>
				</select>				
              </div>
			  <input type="text" value="2" name="reset_cualquiera" hidden=hidden>
            </form>
			<br>
			<div>
					<form class="btns_selectores" method="post" action="admin-usuarios.php">
						<input type="submit" value="Usuarios">
						<!--
						<input type="text" value="resetear" name="reset_inicio" hidden=hidden>
						-->
					</form>
			</div>
			<br>
			<div class="cualquiera">
					<form class="btns_selectores" method="post" action="admin-practicas.php">
						<input type="submit" value="Buenas / Malas prácticas">
						<!--
						<input type="text" value="resetear" name="reset_inicio" hidden=hidden>
						-->
					</form>
			</div>
          </div>
        </aside>
      </div>
      <div class="ed-item base-80">
        <header class="int">
          <h1>Administrador General (Version Alpha)</h1>
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
			<div id="list-image">
				<?php
				
					if(@$id_tienda_get!=''){
						//echo "tienda trae informacion";
						//echo "<br>";
						
						//echo "id tienda: ".$id_tienda_get;
						//echo "<br>";
						
						$fotosTienda = mysqli_query($conexion,"SELECT * FROM registro WHERE id_sala = '$id_tienda_get' AND id_exhibicion = 0 ") or die("Problemas en el select de campana: ".mysqli_error($conexion));
						
						$num_rows = mysqli_num_rows($fotosTienda);
						
						//echo "numero rows: ".$num_rows;
						
						while($reg=mysqli_fetch_array($fotosTienda)){
							$nombre_foto = $reg['nombre_foto'];
							
							//echo "nombre foto: ".$nombre_foto;
							//echo "<br>";
							
							echo "<ul>";
								echo "<li><a href=\"#\" data-featherlight=\"../easy-web/images/$nombre_foto\" > <img src=\"../easy-web/images/$nombre_foto\" width=\"200px\" height=\"200px\" > </a></li>";
							echo "</ul>";
						}
					}
					
					if(@$id_campana_get!=''){
						
						$fotosCampana = mysqli_query($conexion,"SELECT * FROM registro WHERE id_campana = '$id_campana_get' AND id_exhibicion = 0 ") or die("Problemas en el select de campana: ".mysqli_error($conexion));
						
						while($reg=mysqli_fetch_array($fotosCampana)){
							$nombre_foto = $reg['nombre_foto'];
							
							//echo "nombre foto: ".$nombre_foto;
							//echo "<br>";
							
							echo "<ul>";
								echo "<li><a href=\"#\" data-featherlight=\"../easy-web/images/$nombre_foto\" > <img src=\"../easy-web/images/$nombre_foto\" width=\"200px\" height=\"200px\" > </a></li>";
							echo "</ul>";
						}
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