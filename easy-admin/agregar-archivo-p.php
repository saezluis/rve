<?php

header('Content-Type: text/html; charset=UTF-8');

$id_camp = $_REQUEST['id_camp'];
include_once 'config.php';
	
$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
$acentos = $conexion->query("SET NAMES 'utf8'");


$xd = basename(@$_FILES["upload"]["name"]);
	
		if($xd!=''){
			
			$target_dir = "archivos/";
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
			/*
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
			*/
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "Lo sentimos, el archivo ya existe.";
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
			
			if($imageFileType != "pdf" && $imageFileType != "PDF" ) {
				echo "Lo sentimos, solo archivos PDF son permitidos.";
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
					echo "Archivo cargado con éxito";
					echo "<br>";
					//$nombreFoto
					//aqui hago el update
					mysqli_query($conexion,"UPDATE exhibicion SET archivo_pdf = '$nombreFoto' WHERE id_exhibicion = $id_camp ") or die("Problemas en el update".mysqli_error);
				} else {
					echo "Lo sentimos, hubo un error al subir el archivo.";
					echo "<br>";
				}
			}
			
		
		}	
		
		echo "<form method=\"POST\" action=\"admin-practica-proveedores.php\">";
			echo "<input type=\"text\" name=\"id_proveedor\" value=\"$id_camp\" hidden=hidden>";
			echo "<input type=\"submit\" value=\"Volver\">";
		echo "</form>";

?>