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
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<link rel="stylesheet" href="css/styles.css">
	
    <title>Admin</title>
	
	<!--
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slides.js"></script>
	-->
	
	<link rel="stylesheet" href="css2/global.css">
	
	
	

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
		
		$registrosExhibicion = mysqli_query($conexion,"SELECT * FROM exhibicion") or die("Problemas en el select de exhibicion: ".mysqli_error($conexion));
		$registrosSala = mysqli_query($conexion,"SELECT * FROM sala") or die("Problemas en el select de sala: ".mysqli_error($conexion));
		
		@$id_exhibicion_get = @$_REQUEST['tipo_ex'];
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
            <h1>Exhibiciones 2016</h1>
			<div class="init_inicio">
					<form method="post" action="exhibicion.php">
						<input type="submit" value="Inicio">
						<input type="text" value="resetear" name="reset_inicio" hidden=hidden>
					</form>
			</div>			
            <form id="choose" method="post" action="exhibicion.php">				
              <div class="campana">
                <h2>Seleccionar exhibición</h2>                
				<select class="select" name="tipo_ex">
					<?php
						echo "<option value=\"\">Seleccione</option>";
						while($reg=mysqli_fetch_array($registrosExhibicion)){
							$nombre = $reg['nombre'];
							$id_exhibicion = $reg['id_exhibicion'];
							if(@$id_exhibicion_get==$id_exhibicion){
								echo "<option value=\"$id_exhibicion\" selected=selected>$nombre</option>";
							}else{
								echo "<option value=\"$id_exhibicion\">$nombre</option>";
							}
							
						}
					?>
				</select>				
              </div>			
              <div class="tienda">
                <h2>Seleccionar tienda</h2>
                <select class="select" name="tienda" onchange="this.form.submit()">
					<?php
						echo "<option value=\"\">Seleccione</option>";
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
			  <input type="text" value="2" name="reset_cualquiera" hidden=hidden>
            </form>
			<br>
			<div>
					<form class="btns_selectores" method="post" action="estadisticas-exhibicion-por-tienda.php">
						<input type="submit" value="Estadísticas por tienda">
						<!--
						<input type="text" value="resetear" name="reset_inicio" hidden=hidden>
						-->
					</form>
			</div>
			<br>
			<div>
					<form class="btns_selectores" method="post" action="estadisticas-por-exhibicion.php">
						<input type="submit" value="Estadísticas por exhibición">
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
          <h1>Supervisor (exhibición)</h1>
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
				<div id="slides">
					<div class="slides_container">						
						<?php
							
							$c = 0;
							if($reset_index=='resetear' || $cualquiera==1){
								echo "<div class=\"slide\">";								
									echo "<img src=\"img/landing.jpg\">";
										echo "<div class=\"caption\">";
											//echo "<p align=\"center\">Bienvenido al sistema de Registro Visual Easy</p>";
										echo "</div>";
								echo "</div>";
							}
							
							//Registro imagenes, la campana viene de la variable de sesion y la tienda del request
							/*
							if($id_campana_get!=''){
								$registroFotos = mysqli_query($conexion,"SELECT * FROM registro WHERE id_campana = '$id_campana_get'") or die("Problemas en el select de campana: ".mysqli_error($conexion));
							}
							
							if($id_tienda_get!=''){
								$registroFotos = mysqli_query($conexion,"SELECT * FROM registro WHERE id_sala = '$id_tienda_get'") or die("Problemas en el select de tienda: ".mysqli_error($conexion));
							}
							*/
							
							//@$id_campana_new = @$_SESSION['campana_set'];
							//@$id_tienda_get = @$_SESSION['tienda_set'];
							
							/*
							if(@$id_campana_new!='' AND @$id_tienda_get!=''){
								
							}
							*/
							if($id_exhibicion_get!='' AND $id_tienda_get!=''){
								$registroFotos = mysqli_query($conexion,"SELECT * FROM registro WHERE id_exhibicion = '$id_exhibicion_get' AND id_sala = '$id_tienda_get'") or die("Problemas en el select de campana: ".mysqli_error($conexion));
							}
							
							while($reg=mysqli_fetch_array($registroFotos)){
								$id_foto = $reg['id_registro'];
								$nombre_foto = $reg['nombre_foto'];
								$id_member = $reg['id_member'];
								$id_sala = $reg['id_sala'];
								$comentario = $reg['comentario'];
								//$celular = $reg['celular'];
								
								$registroMember = mysqli_query($conexion,"SELECT * FROM members WHERE id = '$id_member'") or die("Problemas en el select de registro: ".mysqli_error($conexion));
								
								if($reg2=mysqli_fetch_array($registroMember)){
									$id_mem = $reg2['id'];
									$nombre = $reg2['nombre'];
									$celular = $reg2['celular'];
								}
								
								$registrosSala = mysqli_query($conexion,"SELECT * FROM sala WHERE id_sala = '$id_sala'") or die("Problemas en el select de sala: ".mysqli_error($conexion));
								
								if($reg3=mysqli_fetch_array($registrosSala)){
									$nombre_sala = $reg3['nombre_sala'];
								}
								
								echo "<div class=\"slide\">";
								//echo "<img src=\"../easy-web/images/$nombre_foto\" title=\"Imágen tomada por: $nombre\">";
									echo "<img src=\"../easy-web/images/$nombre_foto\">";
								
								echo "<div class=\"caption\">";
									echo "<p>Imágen tomada por $nombre en $nombre_sala - Teléfono: $celular</p>";
								echo "</div>";
								
								$c = $c + 1;
								$m = 'message'.$c;
								
								echo "<div class=\"content-caja-mensajes\">";
									echo "<form id=\"$m\" class=\"message\">"; //method=\"post\" action=\"visual.php\"
										echo "<h3>Comentarios</h3>";
										echo "<textarea name=\"mensaje_supervisor\">$comentario</textarea>";										
										echo "<input type=\"submit\" value=\"Enviar\" class=\"enviar\" >";
										echo "<input type=\"text\" value=\"1\" name=\"comentario_activo\" hidden=hidden>";
										//echo "<input type=\"text\" value=\"$id_mem\" name=\"member_activo\" hidden=hidden>";
										echo "<input type=\"text\" value=\"$id_foto\" name=\"foto_activo\" hidden=hidden>";
										//$id_foto
									echo "</form>";
								echo "</div>";
								
								echo "</div>";								
							}
							
							$rows = mysqli_num_rows($registroFotos);
							
							if($rows==0){
								echo "<div class=\"slide\">";								
									echo "<img src=\"img/landing_error.jpg\">";
										echo "<div class=\"caption\">";
											//echo "<p align=\"center\">Información: No hay fotos que cumplan el criterio de búsqueda.</p>";
										echo "</div>";								
								echo "</div>";
							}
							
						?>
						
						<!--
						<div class="slide">

								<img src="http://placehold.it/940x400">

							<div class="caption">
								<p>Imágen tomada por Luis Sáez en Easy Puente Alto - Teléfono: 09-234-8321</p>
							</div>
					        <div class="content-caja-mensajes">
					          <form id="message">
					            <h3>Comentarios</h3>
					            <textarea></textarea>
					            <input type="submit" value="Enviar" class="enviar">
					          </form>
					        </div>
						</div>

						<div class="slide">

								<img src="http://placehold.it/940x400">

							<div class="caption">
								<p>Imágen tomada por Luis Sáez en Easy Puente Alto - Teléfono: 09-234-8321</p>
							</div>
					        <div class="content-caja-mensajes">
					          <form id="message">
					            <h3>Comentarios</h3>
					            <textarea></textarea>
					            <input type="submit" value="Enviar" class="enviar">
					          </form>
					        </div>
						</div>
						-->
					</div>
					<?php
					if($id_exhibicion_get!='' AND $id_tienda_get!=''){
						echo "<a href=\"#\" class=\"prev\"><img src=\"img2/arrow-prev.png\" width=\"24\" height=\"43\" alt=\"Arrow Prev\"></a>";
						echo "<a href=\"#\" class=\"next\"><img src=\"img2/arrow-next.png\" width=\"24\" height=\"43\" alt=\"Arrow Next\"></a>";
					}
					?>
				</div>
				<img src="img2/example-frame.png" width="739" height="341" alt="Example Frame" id="frame">
			</div>			
		</div>		
     </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script src="js2/slides.min.jquery.js"></script>
	
	<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: 'img2/loading.gif',
				play: 0,
				pause: 2500,
				hoverPause: true,
				animationStart: function(current){
					// $('.caption').animate({
					// 	bottom:-35
					// },100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
					// $('.caption').animate({
					// 	bottom:0
					// },200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					// $('.caption').animate({
					// 	bottom:0
					// },200);
				}
			});
		});
	</script>
	
	<script src="js/comentarios.js"></script>
	<!--
	<script type="text/javascript">
		
	</script>
	-->
  </body>
</html>