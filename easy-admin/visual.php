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
		$registrosExhibicion = mysqli_query($conexion,"SELECT * FROM exhibicion") or die("Problemas en el select de exhibicion: ".mysqli_error($conexion));
		
		@$id_campana_get = @$_REQUEST['campana'];
		echo "id_campana: ".$id_campana_get;
		echo "<br>";
		
		@$id_exhibicion_get = @$_REQUEST['exhibicion'];
		echo "id_exhibicion: ".$id_exhibicion_get;
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