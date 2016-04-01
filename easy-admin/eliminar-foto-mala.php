<script type="text/javascript">
	var wait=setTimeout("document.xyz.submit();",100);
</script>
<?php

	$id_foto = $_REQUEST['id_foto_send'];
	$id_campana = $_REQUEST['id_campana_send'];
	
	include_once 'config.php';
	
	$conexion = mysqli_connect($host,$username,$password,$db_name) or die("Problemas con la conexión");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	
	$registrosFotos = mysqli_query($conexion,"SELECT * FROM fotos_practicas WHERE id_foto = '$id_foto' ") or die("Problemas en el select de campana: ".mysqli_error($conexion));
	
	if($regF=mysqli_fetch_array($registrosFotos)){
		$nombreF = $regF['nombre'];
		//$id_foto = $regF['id_foto'];
	}
	
	
	$paraUnlink = "images/".$nombreF;
	
	//echo $paraUnlink;
	//le doy la ruta y el nombre de la foto
	unlink($paraUnlink);
	
	mysqli_query($conexion,"DELETE FROM fotos_practicas WHERE id_foto = '$id_foto' ") or die("Problemas en el select de delete foto: ".mysqli_error($conexion));
	
	echo "<form name=\"xyz\" method=\"post\" action=\"malas-practicas.php\">";
		echo "<input type=\"text\" name=\"id_campana\" value=\"$id_campana\" hidden=hidden>";
	echo "</form>";
	
	
?>