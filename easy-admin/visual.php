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
    
	<link rel="stylesheet" href="css/styles.css">
	
    <title>Admin</title>
	
	<!--
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.slides.js"></script>
	-->
	
	<link rel="stylesheet" href="css2/global.css">
	
	<style>
            #dv1{ border:1px solid #DBDCE9; height: auto;  margin-left:auto; margin-right:auto;  width:100%; border-radius:7px;   padding: 25px; }
            /*div {width: 100%;}*/
            
            ul {list-style-type: none;  margin: 0;padding: 0;            }
            li {font: 1px Helvetica, Verdana, sans-serif; padding:1em 0; font-size:0.9em;               border-bottom: 1px solid #ccc;            }
            li:last-child {border: none; }
            li a { text-decoration: none; color: #000; display: block;        }
			
    </style>
	

  </head>
  <body>
	<?php
		
		error_reporting(0);
		
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
            <h1>Campañas 2016</h1>
			<div class="init_inicio">
					<form method="post" action="visual.php">
						<input type="submit" value="Inicio">
						<input class="inicio_reset" type="text" value="resetear" name="reset_inicio" hidden=hidden>
					</form>
			</div>			
            <form id="choose" method="post" action="visual.php">             
              <div class="tienda">
                <h2>Seleccionar tienda</h2>
                <select class="select" name="tienda">
					<?php
						echo "<option value=\"0\">Seleccione</option>";
						//echo "<option value=\"todas\">Todas</option>";
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
                <h2>Seleccionar Item RVE</h2>                
				<select class="select" name="campana" onchange="this.form.submit()">
					<?php
						echo "<option value=\"0\">Seleccione</option>";
						//echo "<option value=\"todas\">Todos</option>";
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
					<form class="btns_selectores" method="post" action="estadisticas-por-tienda.php">
						<input type="submit" value="Estadísticas por tienda">
						<!--
						<input type="text" value="resetear" name="reset_inicio" hidden=hidden>
						-->
					</form>
			</div>
			<br>
			<div>
					<form class="btns_selectores" method="post" action="estadisticas-por-campana.php">
						<input type="submit" value="Estadísticas por campaña">
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
          <h1>Supervisor (visual)</h1>
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
							
							$x = 0;
							$y = 1;
							
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
							if($id_campana_get!='' AND $id_tienda_get!=''){
								$registroFotos = mysqli_query($conexion,"SELECT * FROM registro WHERE id_campana = '$id_campana_get' AND id_sala = '$id_tienda_get'") or die("Problemas en el select de campana: ".mysqli_error($conexion));
									
							}
							
							//$nro_fotos = mysqli_num_rows($registroFotos);
							//echo "nro de fotos: ".$nro_fotos;
							
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
									$email = $reg2['username'];
								}
								
								$registrosSala = mysqli_query($conexion,"SELECT * FROM sala WHERE id_sala = '$id_sala'") or die("Problemas en el select de sala: ".mysqli_error($conexion));
								
								if($reg3=mysqli_fetch_array($registrosSala)){
									$nombre_sala = $reg3['nombre_sala'];
								}
								
								$registroCampana = mysqli_query($conexion,"SELECT * FROM campana WHERE id_campana = '$id_campana_get'") or die("Problemas en el select campana: ".mysqli_error($conexion));
								
								if($rowC = mysqli_fetch_array($registroCampana)){
									$nombre_C = $rowC['nombre'];
								}
								
								echo "<div class=\"slide\">";
								//echo "<img src=\"../easy-web/images/$nombre_foto\" title=\"Imágen tomada por: $nombre\">";
									echo "<img src=\"../easy-web/images/$nombre_foto\">";
								
								echo "<div class=\"caption\">";
									echo "<p>Imágen tomada por $nombre en $nombre_sala - Teléfono: $celular</p>";
								echo "</div>";								
								
								$c = $c + 1;
								$m = 'message'.$c;
								
								/*
								if($x%2 == 0){
									//$class = 'even';
									$nn = 'n'.$x;
									echo $nn;
								}
								*/
								$nn = 'n'.$x;
								//echo $nn;
								$x = $x + 2;
								//echo "x: ".$x;
								//echo "<br>";
								//$class = 'odd';								
								
								$nm = 'n'.$y;
								//echo $nm;
								$y = $y + 2;
								//echo "y: ".$y;
								//echo "<br>";
								
								//con esto lleno el array con los nombres de las fotos
								
								$result = mysqli_query($conexion,"SELECT * FROM comentarios WHERE id_foto = '$id_foto' ORDER BY id_comentario DESC") or die("Problemas en el select comentario: ".mysqli_error($conexion));
								$results = array();
								while($row = mysqli_fetch_assoc($result))
								{
									$comentariofoto = $row['comentario'];
									$results[] = $comentariofoto;
								}
								
								$cantidad_comentarios = mysqli_num_rows($result);
								//echo "comentario 1: ".$results[2];
								//echo "cantidad de comentarios: ".$cantidad_comentarios;
								
								echo "<div id=\"dv1\" class=\"content-caja-mensajes\">";								
									echo "<form ng-controller=\"FrmController\" id=\"$m\" class=\"message\">"; //method=\"post\" action=\"visual.php\"
										echo "<h4>Comentario:</h4>";										
										echo "<textarea ng-model=\"txtcomment\" id=\"$nn\" onkeyup=\"sync()\"></textarea>";
										echo "<textarea name=\"mensaje_supervisor\" id=\"$nm\" hidden=hidden></textarea>";
										echo "<input ng-click=\"btn_add();\" type=\"submit\" value=\"Enviar\" class=\"enviar\" >";
										echo "<input type=\"text\" value=\"1\" name=\"comentario_activo\" hidden=hidden>";
										//echo "<input type=\"text\" value=\"$id_mem\" name=\"member_activo\" hidden=hidden>";
										echo "<input type=\"text\" value=\"$id_foto\" name=\"foto_activo\" hidden=hidden>";
										echo "<input type=\"text\" value=\"$email\" name=\"email_activo\" hidden=hidden>";
										echo "<input type=\"text\" value=\"$nombre_C\" name=\"campana_activa\" hidden=hidden>";
										//$id_foto
										echo "<h4>Comentarios anteriores:</h4>";
											echo "<ul>";												
												echo "<li ng-repeat=\"comnt in comment\"> {{ comnt }} </li>"; //<a  style=\"float: right;\" href=\"\" ng-click=\"remItem($index)\">x</a>												
												//con esto recorro los comentarios anteriores	
												for ($xx = 0; $xx < $cantidad_comentarios; $xx++) {
													//echo "The number is: $x <br>";
													echo "<li>".$results[$xx]."</li>";
												} 												
											echo "</ul>";
									echo "</form>";
									//echo "<p align=\"left\">Comentarios anteriores: </p>";
									//echo "<p align=\"left\">$comentario</p>";
									echo "<br>";
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
						
					</div>
					<?php
					if($id_campana_get!='' AND $id_tienda_get!=''){
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
		
			var total = $("#slides img").length - 2; // Subtract Two arrows
			
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
					
					if (current == 1) {
						$(".prev").hide();
					}else{
						$(".prev").show();
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
					/*
					if ($('.pagination li:last').hasClass('current')) {
						pause();
					}
					*/
					if (current >= total) {
						clearInterval($('#slides').data('interval'));
						//$(".pagination").remove();
						//$(".prev").remove();
						$(".next").hide();
						//pause();
                    }else{
						$(".next").show();
					};
					
					if (current == 1) {
						$(".prev").hide();
					}else{
						$(".prev").show();
					};
					//$(".prev").click(play());
					
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
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
	
	<script type="text/javascript">
            function FrmController($scope) {
                $scope.comment = [];
                $scope.btn_add = function() {
                    if($scope.txtcomment !=''){
                    $scope.comment.push($scope.txtcomment);
                    $scope.txtcomment = "";
                    }
                }

                $scope.remItem = function($index) {
                    $scope.comment.splice($index, 1);
                }
            }
    </script>
	
	<script src="js/sync.js"></script>
	
  </body>
</html>