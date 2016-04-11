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
    <link rel="shortcut icon" type="image/png" href="favicon.png">
	<link rel="stylesheet" href="css/sss.css" type="text/css" media="all">
    <title>Registro Visual Easy</title>
	
  </head>
  <body>
	<?php
	
		include_once 'config.php';
	
		$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
			
		$nombre_user = $_SESSION['nombre_user'];
		
		$campana_store = @$_REQUEST['campana'];		
		if($campana_store!=''){
			$_SESSION['c_store'] = $campana_store;
		}
		//echo "session c_store lleva: ".$_SESSION['c_store'];
		//echo "<br>";
		
		$registrosCampana = mysqli_query($conexion, " SELECT * FROM campana WHERE id_campana = '$campana_store' ") or die("Problemas con la conexión de campana");
		
		//$num_regs_campana = mysqli_num_rows($registrosCampana);
		
		if($regCamp=mysqli_fetch_array($registrosCampana)){
			$practica_camp = $regCamp['practica'];
		}
		
		if($practica_camp=='no'){
			//aqui llamo el redirect
			//$desdeI = 'si';
			header("Location: take.php?imp="."si");
			//$ney = '';
		}
		
		$exhibicion_store = @$_REQUEST['exhibicion'];
		if($exhibicion_store!=''){
			$_SESSION['e_store'] = $exhibicion_store;
		}
		//echo "session store lleva: ".$_SESSION['e_store'];
		//echo "<br>";
		
		$registrosExhibicion = mysqli_query($conexion, " SELECT * FROM exhibicion WHERE id_exhibicion = '$exhibicion_store' ") or die("Problemas con la conexión de campana");
		
		if($regEx=mysqli_fetch_array($registrosExhibicion)){
			$practica_ex = $regEx['practica'];
		}
		
		if(@$practica_ex=='no'){
			//aqui llamo el redirect
			//$desdeI = 'si';
			header("Location: take.php?imp="."si");
			//$ney = '';
		}
		
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
      <p class="Bot-ti">Cómo implementar esta: campaña / exhibición</p>
      <div class="ed-container">
        <div class="ed-item base-100 no-padding">
          <ul class="tabs">
			<?php
			
			
			
			if($campana_store!=''){
				$registrosFotos = mysqli_query($conexion,"SELECT * FROM fotos_practicas WHERE id_campana = '$campana_store' AND condicion = 'buena' ") or die("Problemas en el select de fotos: ".mysqli_error($conexion));
				
				$registrosTexto = mysqli_query($conexion,"SELECT * FROM textos WHERE id_campana = '$campana_store' AND tipo_practica = 'buena' ") or die("Problemas en el select de fotos: ".mysqli_error($conexion));
				//echo "entro por campaña";
				$registrosFotosM = mysqli_query($conexion,"SELECT * FROM fotos_practicas WHERE id_campana = '$campana_store' AND condicion = 'mala' ") or die("Problemas en el select de fotos: ".mysqli_error($conexion));
				
				$registrosTextoM = mysqli_query($conexion,"SELECT * FROM textos WHERE id_campana = '$campana_store' AND tipo_practica = 'mala' ") or die("Problemas en el select de fotos: ".mysqli_error($conexion));
			}
			
            echo "<li class=\"Tm\">";
              echo "<input id=\"tab1\" type=\"radio\" name=\"tabs\" checked=\"\">";
              echo "<label for=\"tab1\">Buenas Prácticas</label>";
			  
              echo "<div id=\"tab-content1\" class=\"tab-content\">";
				if($regT=mysqli_fetch_array($registrosTexto)){
					$texto_bp = $regT['texto'];
					echo "<p>$texto_bp</p>";
				}                
				echo "<div class=\"ima-B-M\">";
                  echo "<div class=\"corchete-l\"><img src=\"img/corchete_mobile_left.png\" alt=\"\"></div>";
					echo "<div class=\"slider\">";
						while($regF=mysqli_fetch_array($registrosFotos)){
							$nombreF = $regF['nombre'];
							echo "<img height=\"42\" width=\"42\" src=\"../easy-admin/images/$nombreF\" alt=\"\">";
						}						
						//echo "<img src=\"img/foto2.jpg\" alt=\"\">";
						//echo "<img src=\"img/foto3.jpg\" alt=\"\">";
					echo "</div>";
				  echo "<div class=\"corchete-r\"><img src=\"img/corchete_mobile_right.png\" alt=\"\"></div>";
                echo "</div>";                
              echo "</div>";
            echo "</li>";
            
			echo "<li>";
              echo "<input id=\"tab2\" type=\"radio\" name=\"tabs\">";
              echo "<label for=\"tab2\">Malas Prácticas</label>";
              echo "<div id=\"tab-content2\" class=\"tab-content\">";
			  if($regT=mysqli_fetch_array($registrosTextoM)){
					$texto_bp = $regT['texto'];
					echo "<p>$texto_bp</p>";
				}
			   //echo "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>";
                echo "<div class=\"ima-B-M\">";
                  echo "<div class=\"corchete-l\"><img src=\"img/corchete_mobile_left.png\" alt=\"\"></div>";
                  echo "<div class=\"slider\">";
						while($regF=mysqli_fetch_array($registrosFotosM)){
							$nombreF = $regF['nombre'];
							echo "<img height=\"42\" width=\"42\" src=\"../easy-admin/images/$nombreF\" alt=\"\">";
						}
						//echo "<img src=\"img/foto2-no.jpg\" alt=\"\">";
						//echo "<img src=\"img/foto3-no.jpg\" alt=\"\">";
					echo "</div>";
                  echo "<div class=\"corchete-r\"><img src=\"img/corchete_mobile_right.png\" alt=\"\"></div>";
                echo "</div>";               
              echo "</div>";
            echo "</li>";			
			?>
          </ul>
        </div>
      </div>
    </section>
    <section class="go">
  		<form method="post" action="take.php" class="vayale">
			<input type="text" value="si" name="aceptar_implementar" hidden=hidden>
  			<input type="submit" value="Aceptar" class="aceptar-button">			
			<input type="button" value="atrás" onclick="location.href='seleccionar.php';" class="aceptar-button">
		</form>		
		
		
  		
		<!--
		<a href="take.php" class="aceptar">Aceptar</a>
		-->
	</section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/scripts.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="js/sss.min.js"></script>
	<script>
		jQuery(function($) {
		$('.slider').sss({
			slideShow : true	});
		});
	</script>
	
  </body>
</html>