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
		
		include_once 'config.php';
	
		$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		$registrosCampana = mysqli_query($conexion,"SELECT * FROM campana") or die("Problemas en el select de campana: ".mysqli_error($conexion));
		$registrosSala = mysqli_query($conexion,"SELECT * FROM sala") or die("Problemas en el select de sala: ".mysqli_error($conexion));
		
		@$id_campana_get = @$_REQUEST['campana'];
		echo "id_campana: ".$id_campana_get;
		echo "<br>";
		
		@$id_tienda_get = @$_REQUEST['tienda'];
		echo "id_tienda: ".$id_tienda_get;
		echo "<br>";
		
	?>
    <div class="ed-container">
      <div class="ed-item base-20">
        <aside>
          <div class="logo"><img src="img/logo.png" alt=""></div>
          <div class="aqui-les-va">
            <h1>Campañas 2016</h1>
            <form id="choose" method="post" action="visual.php">
              <div class="campana">
                <h2>Seleccionar campaña</h2>                
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
              </div>
              <div class="tienda">
                <h2>Seleccionar tienda</h2>
                <select class="select" name="tienda" onchange="this.form.submit()">
					<?php
						echo "<option value=\"\">Seleccione</option>";
						while($reg=mysqli_fetch_array($registrosSala)){
							$nombre_sala = $reg['nombre_sala'];
							$id_sala = $reg['id_sala'];
							echo "<option value=\"$id_sala\">$nombre_sala</option>";
						}
					?>
				</select>
              </div>
            </form>
          </div>
        </aside>
      </div>
      <div class="ed-item base-80">
        <header class="int">
          <h1>Supervisor (visual)</h1>
          <div class="items-header">
            <div class="custion">
              <div class="profile"><img src="img/carita.jpg" alt="" class="circulo"></div>
              <p class="nombre">¡Hola! Elisa Correa S.</p><a href="logout.php" class="rejected">Cerrar sesión</a>
            </div>
          </div>
        </header>
		
		<div id="container">
			<div id="example">				
				<div id="slides">
					<div class="slides_container">						
						<?php
							//Registro imagenes
							if($id_campana_get!=''){
								$registroFotos = mysqli_query($conexion,"SELECT * FROM registro WHERE id_campana = '$id_campana_get'") or die("Problemas en el select de campana: ".mysqli_error($conexion));
							}
							
							if($id_tienda_get!=''){
								$registroFotos = mysqli_query($conexion,"SELECT * FROM registro WHERE id_sala = '$id_tienda_get'") or die("Problemas en el select de tienda: ".mysqli_error($conexion));
							}
							
							while($reg=mysqli_fetch_array($registroFotos)){
								$nombre_foto = $reg['nombre_foto'];
								$id_member = $reg['id_member'];
								$id_sala = $reg['id_sala'];
								//$celular = $reg['celular'];
								
								$registroMember = mysqli_query($conexion,"SELECT * FROM members WHERE id = '$id_member'") or die("Problemas en el select de registro: ".mysqli_error($conexion));
								
								if($reg2=mysqli_fetch_array($registroMember)){
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
								echo "<div class=\"content-caja-mensajes\">";
									echo "<form id=\"message\">";
										echo "<h3>Comentarios</h3>";
										echo "<textarea></textarea>";
										echo "<input type=\"submit\" value=\"Enviar\" class=\"enviar\">";
									echo "</form>";
								echo "</div>";
								
								echo "</div>";
							}
							
							//echo "<div class=\"caption\" style=\"bottom:0\">";
									//echo "<p>Happy Bokeh Thursday!</p>";
							//echo "</div>";
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
					<a href="#" class="prev"><img src="img2/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
					<a href="#" class="next"><img src="img2/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
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
  </body>
</html>