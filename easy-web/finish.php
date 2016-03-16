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
    <link rel="stylesheet" href="css/set2.css">
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    <title>Registro Visual Easy</title>
  </head>
  <body>
	<?php
	$nombre_user = $_SESSION['nombre_user'];
	$nombreFoto = "";
	//uniqid();
	
	$xd = basename(@$_FILES["upload"]["name"]);
	
		if($xd!=''){
			
			$target_dir = "./images/";
			$nombreFoto = uniqid().basename($_FILES["upload"]["name"]);
			$target_file = $target_dir.$nombreFoto;
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["upload"]["tmp_name"]);
				if($check !== false) {
					echo "El archivo es una imagen - " . $check["mime"] . ".";
					echo "<br>";
					$uploadOk = 1;
				} else {
					echo "El archivo no es una imagen.";
					echo "<br>";
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "Lo sentimos, el archivo ya existe.";
				echo "<br>";
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["upload"]["size"] > 3000000) {
				echo "Lo sentimos, el archivo es muy grande.";
				echo "<br>";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Lo sentimos, solo archivos JPG, JPEG, PNG & GIF son permitidos.";
				echo "<br>";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Lo sentimos, su archivo no fue cargado.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
					//echo "El archivo ". basename( $_FILES["upload"]["name"]). " a sido cargado.";
					echo "<br>";
				} else {
					echo "Lo sentimos, hubo un error al subir el archivo.";
					echo "<br>";
				}
			}
		
		}	

		//$nombreFoto = uniqid().basename($_FILES["upload"]["name"]);
		
		//echo "nombre foto: ".$nombreFoto;
		echo "<br>";
		echo "<br>";
		
		$id = $_SESSION['id_usuario'];
		//echo "id usuario: ".$id;
		//echo "<br>"."<br>";
		
		//$_SESSION['id_sala'] = $id_sala;
		$sala_store = $_SESSION['id_sala'];
		//echo "id sala: ".$sala_store;
		//echo "<br>"."<br>";
		
		$campana_store = @$_SESSION['c_store'];
		//echo "camapana: ".$campana_store;
		//echo "<br>"."<br>";
		
		$exhibicion_store = @$_SESSION['e_store'];
		//echo "exhibicion: ".$exhibicion_store;
		//echo "<br>"."<br>";
		
		date_default_timezone_set("America/Santiago");
		$date =  date("Y-m-d h:i:sa");
		$timestamp = date('Y-m-d H:i:s', strtotime($date));
		
		include_once 'config.php';
	
		$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		mysqli_query($conexion,"INSERT INTO registro(id_member,id_sala,id_campana,id_exhibicion,nombre_foto,fecha) VALUES
									('$id',
									'$sala_store',
									'$campana_store',
									'$exhibicion_store',
									'$nombreFoto',
									'$timestamp'
									)")
		or die("Problemas con el insert del registro");
	
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
	  <?php		  
		$siguiente = @$_REQUEST['siguiente_send'];
		
		if($siguiente=='si'){
			echo "<p>Tu foto se subió exitosamente</p>";
			echo "<form id=\"main\">";
				echo "<div class=\"check\"><img src=\"img/check.svg\" alt=\"\"></div>";
			echo "</form>";
		}
		
		if($siguiente!=''){
			echo "";
		}
	  ?>
      
    </section>
	<!-- 
		//colocarlo en un Form y enviar datos necesarios
	-->
<!-- 	<section class="go">
		<form method="post" action="take.php">

			<a href="#" class="aceptar"></a>
			<input type="submit" value="Tomar otra foto" class="cont aceptar">
				
		</form>
	</section>	 -->
	<section class="go">
		<form method="post" action="take.php">
			<input type="submit" value="Tomar otra foto" class="aceptar-nu">
		</form>
	</section>
    <section class="go"><a href="seleccionar.php" class="aceptar-nu">Seleccionar otra campaña / exhibición</a></section>
	<!--
	<section class="go"><a href="logout.php" class="aceptar-nu">Finalizar sesión</a></section>
	-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/scripts.js"></script>
	<?php
		//session_destroy();
		//la que esta en blanco la dejo en blanco la que no la vuevo a guardar..?
		if($campana_store==''){
			$_SESSION['c_store'] = "";
		}else{
			@$_SESSION['c_store'] = $campana_store;
		}
		
		if($exhibicion_store==''){
			$_SESSION['e_store'] = "";
		}else{
			@$_SESSION['e_store'] = $exhibicion_store;
		}
		
	?>	
  </body>
</html>