<script type="text/javascript">

		var wait=setTimeout("document.xyz.submit();",100);

</script>
<?php
	
	include '../easy-web/wideimage/lib/WideImage.php';
	
	$xd = basename(@$_FILES["upload"]["name"]);
	
		if($xd!=''){
			
			$target_dir = "images/";
			$nombreFoto = basename($_FILES["upload"]["name"]); //$nombreFoto = uniqid().basename($_FILES["upload"]["name"]);
			
			//echo "nombre foto antes del fix: ".$nombreFoto;
			//echo "<br>";
			//aqui colocaria la wea pa acomodar la foto
			/*
			function image_fix_orientation($filename) {
				$exif = exif_read_data($filename);
					if (!empty($exif['Orientation'])) {
						$image = imagecreatefromjpeg($filename);
							switch ($exif['Orientation']) {
								case 3:
									$image = imagerotate($image, 180, 0);
									break;

								case 6:
									$image = imagerotate($image, -90, 0);
									break;

								case 8:
									$image = imagerotate($image, 90, 0);
									break;
							}
						imagejpeg($image, $filename, 90);
					}					
			}
			*/
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
				//echo "Lo sentimos, el archivo ya existe.";
				//echo "<br>";
				$edfbs = '';
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
				//echo "Lo sentimos, su archivo no fue cargado.";
				$wap = '';
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

		
		
		//image_fix_orientation($target_file);
		
		$newName = rand(0000000,1111111);
	
		$newNameFinal = $newName.'.jpg';
		
		WideImage::load($target_file)->resize(null, 345)->saveToFile('nombreFinal.jpg');
		
		rename("nombreFinal.jpg",$target_dir . $newNameFinal);
		
		//echo $newNameFinal;
		
		//----------------------------------------------------------------------------------
		
		// Load the stamp and the photo to apply the watermark to
		$stamp = imagecreatefrompng('images/bad.png');
		$im = imagecreatefromjpeg('images/'.$newNameFinal);

		// Set the margins for the stamp and get the height/width of the stamp image
		$marge_right = 0;
		$marge_bottom = 25;
		$sx = imagesx($stamp);
		$sy = imagesy($stamp);

		// Copy the stamp image onto our photo using the margin offsets and the photo 
		// width to calculate positioning of the stamp. 
		imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

		// Output and free memory
		//header('Content-type: image/png');
		//imagepng($im,'images/image5.png');
		imagepng($im,'images/'.$newNameFinal);
		
		//----------------------------------------------------------------------------------
		
		$id_campana = @$_REQUEST['id_campana'];
		$condicion = @$_REQUEST['condicion'];
		
		include_once 'config.php';
	
		$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
		$acentos = $conexion->query("SET NAMES 'utf8'");
		
		mysqli_query($conexion,"INSERT INTO fotos_practicas (nombre,id_campana,condicion) VALUES ('$newNameFinal','$id_campana','$condicion')") or die("Problemas con el insert de fotos");
		
		//echo $target_file;
		
		unlink($target_file);
		
		//header('Location: buenas-malas.php');
		?>
		
	
	
	<?php
		
		echo "<form name=\"xyz\" method=\"post\" action=\"malas-practicas.php\">";
			echo "<input type=\"text\" name=\"id_campana\" value=\"$id_campana\" hidden=hidden>";
		echo "</form>";
		
	?>	

